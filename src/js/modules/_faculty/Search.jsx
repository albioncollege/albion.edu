import {h, createRef} from 'preact';

export default function Search(props) {

  const inputRef = createRef();

  const handleSubmit = (e) => {
    e.preventDefault();
    props.setSearch(inputRef.current.value);
    inputRef
      .current
      .blur();
    return false;
  };

  return (
    <form class="filter__search" onSubmit={handleSubmit}>
      <label class="screen-reader-text" for="filter-search">Search Faculty</label>
      <input
        ref={inputRef}
        id="filter-search"
        type="search"
        autocomplete="false"
        class="filter__search__input"
        placeholder="Search Faculty"
        value={props.search}/>
    </form>

  )
}
