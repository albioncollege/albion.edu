import {h} from 'preact';

export default function FilterDivision(props) {

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
  return (
    <div className="filter__division">
      {opts.map(opt => (
          <label class="filter__label" onChange={handleOptionClick(opt)}>
            <input type="checkbox" checked={currentFilters.indexOf(opt) > -1}/>
            <span class="filter__checkbox">{opt}</span>
          </label>
        ))}
    </div>
  )
}
