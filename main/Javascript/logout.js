document.getElementById("logout").addEventListener("click", function () {
    const fs = require('fs');

    const filePath = path.join(__dirname, `account.json`);

    // Remove the file
    fs.unlink(filePath, (err) => {
    if (err) {
        console.error(`Error removing file: ${err}`);
        return;
    }

    console.log(`File ${filePath} has been successfully removed.`);
    });
});