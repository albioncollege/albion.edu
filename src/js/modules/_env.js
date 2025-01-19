export let dev = false;

if (['localhost', 'albion.jpederson.io'].includes(window.location.hostname)) {
  dev = true;
}

console.log('Dev env: ' + dev)

export default dev;