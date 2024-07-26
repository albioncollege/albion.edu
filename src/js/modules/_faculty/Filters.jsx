import {h} from 'preact';
import {useEffect, useState, useRef} from 'preact/hooks';

import FilterDivision from './FilterDivision';
import FiltersMobile from './FiltersMobile';
import Search from './Search';

function Filter(props) {
  const opts = Object.keys(props.faculty.map(f => f[props.target]).reduce((acc, opts) => [
    ...acc,
    ...opts
  ], []).reduce((acc, opt) => Object.assign(acc, {[opt]: true}), {})).sort((a, b) => a.localeCompare(b, 'en', {sensitivity: 'base'}));

  const currentFilters = props.filters[props.target] || [];

  const handleOptionClick = (option) => () => {
    const active = currentFilters.indexOf(option) > -1;

    if (active) {
      const newFilters = currentFilters.filter(i => i !== option);
      props.setFilters(Object.assign({}, props.filters, {
        [props.target]: newFilters
      }));
    } else {
      const newFilters = [
        ...currentFilters,
        option
      ];
      props.setFilters(Object.assign({}, props.filters, {
        [props.target]: newFilters
      }))
    }
  }

  const node = useRef();

  const [open,
    setOpen] = useState(false);

  const topClasses = open
    ? "filter filter--desktop active"
    : "filter filter--desktop";

  const handleClick = (e) => {
    if (node.current.contains(e.target)) 
      return;
    setOpen(false);
  }

  useEffect(() => {
    document.addEventListener("click", handleClick);

    return () => {
      document.removeEventListener("click", handleClick);
    };
  }, []);

  return (
    <div ref={node} className={topClasses}>
      <button
        className="filter__toggle filter__toggle--arrow button--green"
        onClick={e => setOpen(!open)}>{props.title}</button>
      <div className="filter__content">
        {opts.map(opt => (
          <label class="filter__label" onChange={handleOptionClick(opt)}>
            <input type="checkbox" checked={currentFilters.indexOf(opt) > -1}/>
            <span class="filter__checkbox">{opt}</span>
          </label>
        ))}
      </div>
    </div>
  );
}

export default function Filters(props) {

  return <div>

    <div className="finder__top">
      <div className="filters">

        <FiltersMobile {...props} />

        <Search {...props}/>

        <Filter title="Filter by Arts Area" target="area" {...props}/>

        <FilterDivision target="division" {...props} />

      </div>

    </div>
  </div>
}
