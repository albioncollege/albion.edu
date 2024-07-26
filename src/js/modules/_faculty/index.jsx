import {h, render, Component} from 'preact';
import {useState} from 'preact/hooks';
import ReactPaginate from 'react-paginate';

import Filters from './Filters';
import Faculty from './Faculty';
import Result from './Result';

const finderPage = document.querySelector('.faculty-finder');

if (finderPage) {
  (async() => {
    const response = await fetch(jsonUrl);
    const json = await response.json();
    const rawFaculty = json.faculty;

    const sortedFaculty = rawFaculty.sort(function (a, b) {
      if (a.order === b.order) {
        if (a.lastName === b.lastName) {
          return (a.firstName < b.firstName)
            ? -1
            : (a.firstName > b.firstName)
              ? 1
              : 0;
        } else {
          return (a.lastName < b.lastName)
            ? -1
            : 1;
        }
      } else {
        return (a.order < b.order)
          ? -1
          : 1;
      }
    });

    const faculty = sortedFaculty.map(faculty => {
      return Object.assign(faculty, {
        key: [faculty.name].join(''),
        searchString: [faculty.firstName, faculty.lastName, faculty.title, faculty.search]
          .join(' ')
          .toLowerCase()
          .replace(/[^a-z0-9]/g, '')
      });
    });

    function FacultyFinder(props) {
      const perPage = 8;

      const [page, setPage] = useState(0);
      const [filters, setFiltersActual] = useState({});
      const [search, setSearchActual] = useState("");

      const setFilters = (newFilters) => {
        setFiltersActual(newFilters);
        setPage(0);
      };

      const setSearch = (newSearch) => {
        setSearchActual(newSearch);
        setPage(0);
      };

      const resetFiltersAndSearch = () => {
        setFilters({});
        setSearch('');
      }

      const filteredFaculty = faculty.filter(faculty => {
        let include = true;

        Object
          .keys(filters)
          .forEach(filterName => {
            const filter = filters[filterName];

            if (include === false) 
              return;
            if (filter.length === 0) 
              return;
            
            include = faculty[filterName].some(val => filter.indexOf(val) >= 0);
          });

        if (include) {
          const searchString = search
            .toLowerCase()
            .replace(/[^a-z0-9]/g, '');

          if (searchString.length > 0) {
            if (faculty.searchString.indexOf(searchString) < 0) 
              include = false;
            }
          }

        return include;
      });

      const sliceStart = page * perPage;
      const sliceEnd = sliceStart + perPage;
      const slicedFaculty = filteredFaculty.slice(sliceStart, sliceEnd);

      const count = Math.ceil(filteredFaculty.length / perPage);

      const handleChange = (e) => {
        setPage(e.selected);
      };
      console.log(perPage)
      return (
        <div className="container container--narrow">

          <Filters
            faculty={faculty}
            filters={filters}
            setFilters={setFilters}
            search={search}
            setSearch={setSearch}/>

          <Result
            setFilters={setFilters}
            setSearch={setSearch}
            resetFiltersAndSearch={resetFiltersAndSearch}
            slicedFaculty={slicedFaculty}
            filters={filters}
            search={search}/>

          <div className="finder__bottom">
            {filteredFaculty.length > 0
              ? ''
              : <div class="h5">No Matches</div>}
            <ul className="finder__list--faculty">
              {slicedFaculty.map(f => <Faculty key={f.key} faculty={f}/>)}
            </ul>

            {filteredFaculty.length > perPage
              ? <ReactPaginate
              previousLabel={"prev"}
              previousLinkClassName={"pagination__prev"}
              nextLabel={"next"}
              nextLinkClassName={"pagination__next"}
              pageLinkClassName={"pagination__link"}
              breakClassName={"pagination__summary"}
              pageCount={count}
              pageRangeDisplayed={2}
              marginPagesDisplayed={1}
              onPageChange={handleChange}
              containerClassName={"pagination"}
              activeClassName={"active"}
              forcePage={page}
              />
              : ''
            }
            
          </div>
        </div>
      );
    }

    const App = <FacultyFinder faculty={faculty}/>

    render(App, finderPage);
  })();
}
