//handles the account data 
document.getElementById('signupForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const account = {
        username: document.getElementById('username').value,
        email: document.getElementById('email').value,
        password: document.getElementById('password').value,
        firstname: document.getElementById('firstname').value,
        secondname: document.getElementById('secondname').value,
        age: document.getElementById('age').value
    };

    fetch('/register-account', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(account)
    })
    .then(response => response.json())
    .then(data => {
        alert("Account registered successfully!");
        console.log(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
