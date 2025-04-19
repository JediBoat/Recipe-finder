document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("signupForm").addEventListener("submit", function (e) {
        e.preventDefault(); // Prevent default form submission

        const account = {
            username: document.getElementById("username").value,
            email: document.getElementById("email").value,
            password: document.getElementById("password").value,
            confirmPassword: document.getElementById("confirm-password").value,
            firstname: document.getElementById("firstname").value,
            secondname: document.getElementById("secondname").value,
            age: document.getElementById("age").value
        };

        fetch('/register-account', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(account)
        })
        .then(response => response.json())
        .then(data => {
            alert("Account saved!");
            console.log(data);
        })
        .catch(error => {
            console.error('Error saving account:', error);
        });
    });
});

//logs to check if it's running

document.addEventListener("DOMContentLoaded", () => {
    console.log("signup.js loaded ✅");

    document.getElementById("signupForm").addEventListener("submit", function (e) {
        e.preventDefault();

        console.log("Submit clicked ✅");

        const account = {
            username: document.getElementById("username").value,
            email: document.getElementById("email").value,
            password: document.getElementById("password").value,
            confirmPassword: document.getElementById("confirm-password").value,
            firstname: document.getElementById("firstname").value,
            secondname: document.getElementById("secondname").value,
            age: document.getElementById("age").value
        };

        fetch('/register-account', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(account)
        })
        .then(res => res.json())
        .then(data => {
            alert("Account saved!");
            console.log(data);
        })
        .catch(err => console.error("Account save failed:", err));
    });
});
