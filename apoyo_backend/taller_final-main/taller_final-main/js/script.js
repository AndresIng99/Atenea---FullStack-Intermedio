if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('./sw.js')
    .then(reg => console.log('Registro de service worker exitoso', reg))
    .catch(err => console.warn('Error con el registro del service worker', err))
}