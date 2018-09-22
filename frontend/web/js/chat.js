var conn = new WebSocket('ws://localhost:8080');
conn.onopen = function (e) {
    console.log("Connection established!");
};

conn.onmessage = function (e) {
    document.getElementById('chatMessages').value = document.getElementById('chatMessages').value + e.data + '\n';
    console.log(e.data);
};