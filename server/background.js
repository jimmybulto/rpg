var mysql = require('mysql');
var interval = 5000;
var interval2 = 1000;
var con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "asdf",
    database: "rpg"
});

update();
updatePerSecond();

function update() {
    con.connect(function(err) {
        sql="update users set coins = coins+1;";
        con.query(sql, function (err, result) {
            if (err) throw err;
            console.log("updated coins: ");
        });
    });
    setTimeout(update, interval);
}

function updatePerSecond() {
    con.connect(function(err) {
        sql="update users set miner = miner-1 where miner > -1;";
        con.query(sql, function (err, result) {
            if (err) throw err;
            console.log("updated miner");
        });
    });
    setTimeout(updatePerSecond, interval2);
}