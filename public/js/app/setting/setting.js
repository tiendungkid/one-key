const copyAccessTokenButton = document.getElementById('copy-access-token-btn');
const accessTokenInput = document.getElementById('access_token');
copyAccessTokenButton.addEventListener('click', event => {
    event.preventDefault();
    accessTokenInput.focus();
    accessTokenInput.select();
    document.execCommand('copy');
});
