import {h} from 'preact';
import { useState } from 'preact/hooks';

function FilterMobile(props) {
  const opts = Object.keys(props.faculty.map(f => f[props.target]).reduce((acc, opts) => [
    ...acc,
    ...opts
  ], []).reduce((acc, opt) => Object.assign(acc, {[opt]: true}), {})).sort();

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

  return (

    <div className="filter__group">
      <p className="filter__title">{props.title}</p>
      <div className="filter__content">
        {opts.map(opt => (
          <label className="filter__label" onChange={handleOptionClick(opt)}>
            <input type="checkbox" checked={currentFilters.indexOf(opt) > -1}/>
            <span className="filter__checkbox">{opt}</span>
          </label>
        ))}
      </div>
    </div>

  );

}

export default function FiltersMobile(props) {
  const [open,
    setOpen] = useState(false);

  const topClasses = open
    ? "filter filter--mobile active"
    : "filter filter--mobile";

  return <div className={topClasses}>
    <button
      className="filter__toggle filter__toggle--filter button--green"
      onClick={e => setOpen(!open)}>Filter</button>
    <div className="filter__flyout">
      <button className="filter__flyout__close" onClick={e => setOpen(!open)}>
        <span className="screen-reader-text">Close</span>
      </button>
      <FilterMobile title="Arts Area" target="area" {...props}/>

      <FilterMobile title="Business Unit" target="division" {...props}/>

      <button className="button--green" onClick={e => setOpen(!open)}>Apply</button>
    </div>
  </div>
}
