import { h, createRef } from 'preact';

export default function Faculty(props) {

  const name = `${props.faculty.firstName} ${props.faculty.lastName}`;

  return <li className="finder__faculty" data-order={props.faculty.order}>
    <img src={props.faculty.image} alt="" />
    <p className="h4">
      {props.faculty.url.length ? <a href={props.faculty.url}>{name}</a> : name}
    </p>

    <p className="finder__faculty__title">{props.faculty.title}</p>

  </li>
}
