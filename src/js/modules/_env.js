export let dev = false;

if (['localhost', 'albion.mstoner.com', 'mstoner.ngrok.io'].includes(window.location.hostname)) {
  dev = true;
}

console.log('Dev env: ' + dev)

export default dev;