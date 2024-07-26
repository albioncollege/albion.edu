import {h} from 'preact';

export default function Result(props) {

  const clearSearch = () => {
    props.setSearch('');
  }

  const activeFilters = Object
    .keys(props.filters)
    .map((filterName) => {
      const filterValues = props.filters[filterName];
      return filterValues.map((value) => ({
        type: filterName,
        value,
        remove: () => {
          const currentFilters = props.filters[filterName] || [];
          const newFilters = currentFilters.filter(i => i !== value);

          props.setFilters(Object.assign({}, props.filters, {[filterName]: newFilters}));
        }
      }));
    })
    .reduce((a, b) => [
      ...a,
      ...b
    ], []);

  return <div className="results">

    {activeFilters.map(({type, value, remove}) => <button className="result__button" aria-label="Remove Filter" onClick={remove}>{value}</button>)}

    {props.search.length
      ? <button
          className="result__button"
          onClick={clearSearch}
          aria-labe="Remove Filter">{props.search}</button>
      : ''}

  </div>
}
