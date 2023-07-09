bodyText = document.getElementById('p-body')
bodyText.addEventListener('input', () => {
    document.getElementById('body').value = bodyText.innerText
})
