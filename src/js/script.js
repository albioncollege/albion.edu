import "core-js/features/array/fill";

// polyfills
import 'intersection-observer';

// dependencies
import 'what-input';
import 'whatwg-fetch';

// util
import './util/_minimodal';
import './util/_smoothscroll';
import smoothscroll from 'smoothscroll-polyfill';
import './util/_stickysidebar';

// kick off the polyfill!
smoothscroll.polyfill();

// modules
import './modules/_accordion';
import './modules/_button';
import './modules/_contacts';
import './modules/_footer';
import './modules/_header';
import './modules/_media';
import './modules/_nav';
import './modules/_sidebar';
import './modules/_showcase';
import './modules/_social';
import './modules/_splash';
import './modules/_tabs';
import './modules/_testimonial-slider';
