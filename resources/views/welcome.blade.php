<script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>

user: <input type="text" id="user" value="1">
Name:<input type="text" id="name">
<br>
coins: <input type="text" id="coins">
<br>
HP: <input type="text" id="hp">
<br>
ATK: <input type="text" id="atk"><input type="button" value="+" onclick="levelUp('atk')"><label id="req_atk"></label>
<br>
DEF: <input type="text" id="def"><input type="button" value="+" onclick="levelUp('def')"><label id="req_def"></label>
<br>
<hr>
miners:
<div id="myProgress">
    <div id="myBar"></div>
</div><input type="button" value="mine" onclick="mine()">(100 coins)
<hr>

<br>
rocks: <input type="text" id="rocks" readonly><input type="text"  id="qty_rocks" value="1"><input type="button" value="BUY(50)" onclick="buy('rocks')"><input type="button" value="SELL(20)" onclick="sell('rocks')">
<br>
golds: <input type="text" id="golds" readonly>
<input type="text"  id="qty_golds" value="1"><input type="button" value="BUY(1000)" onclick="buy('golds')"><input type="button" value="SELL(500)" onclick="sell('golds')">
<br><br>
<hr>


<table border="1" id="userlist">

</table><br>
<div id="message" class="box"></div>

<style>
    .box {
        border: 1px solid black;
    }

    #myProgress {
        width: 100px;
        background-color: white;
        border: 1px solid black;
    }

    #myBar {
        width: 1%;
        height: 10px;

        background-color: green;
    }

</style>

<script type="text/javascript">

    var interval = 1000;
    $(document).ready(function () {
        update();
    });

    function update() {
        $.ajax({
            url: 'stats?user=' + $("#user").val(),
            type: 'get',
            success: function (data) {

                $("#coins").val(data['coins']);
                $("#name").val(data['name']);
                $("#hp").val(data['hp']);
                $("#atk").val(data['atk']);

                var req_rocks =(data['atk']%10)*20;
                var req_golds =Math.floor((data['atk']/10)*2);
                $("#req_atk").text("Required: Rocks="+req_rocks+" Golds="+req_golds);

                $("#def").val(data['def']);
                var req_rocks =(data['def']%10)*20;
                var req_golds =Math.floor((data['def']/10)*2);
                $("#req_def").text("Required: Rocks="+req_rocks+" Golds="+req_golds);

                $("#rocks").val(data['rocks']);
                $("#golds").val(data['golds']);
                $("#house").val(data['house']);
                var d = new Date();
                if (data['message'])
                    $("#message").html(d.toDateString() + ": "+data['message'] + "<br>"+$("#message").html());
                move(data['miner']);
                var rank = data['ranking'];
                $("#ranking").html('');
                var ctr = 1;

                var table = document.getElementById("userlist");
                $("#userlist").children().remove();
                var row = table.insertRow(0);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                cell1.innerHTML = "RANK";
                cell2.innerHTML = "NAME";
                cell3.innerHTML = "COINS";
                cell4.innerHTML = "ACTION";


                rank.forEach(function (entry) {

                    var row = table.insertRow(ctr);
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    var cell4 = row.insertCell(3);
                    cell1.innerHTML = ctr;
                    cell2.innerHTML = entry['name'];
                    cell3.innerHTML = entry['coins'];
                    cell4.innerHTML = "<input type='button' value='attack' onclick='attack("+entry['id']+")'>";
                    ctr++;
                });

                    setTimeout(update, interval);
            },
            error: function () {
                setTimeout(update, interval);
            }
        }); // end ajax call
    }

    function mine() {
        $.ajax({
            url: "mine?user=" + $('#user').val(),
            type: 'get',

            success: function (data) {
                update()
            },
            error: function () {

            }
        }); // end ajax call
    }

    function move(width) {

        var elem = document.getElementById("myBar");
        if(width<1)
            elem.style.width ='0%';
        var tot = (width / 30) * 100;
        elem.style.width = tot + '%';
    }

    function buy(type) {
        $.ajax({
            url: "buy?type="+type+"&user=" + $('#user').val()+"&qty="+$('#qty_'+type).val(),
            type: 'get',

            success: function (data) {
                update();
                $('#qty_'+type).val(1);
            },
            error: function () {

            }
        }); // end ajax call
    }

    function sell(type) {
        $.ajax({
            url: "sell?type="+type+"&user=" + $('#user').val()+"&qty="+$('#qty_'+type).val(),
            type: 'get',

            success: function (data) {
                update();
                $('#qty_'+type).val(1);
            },
            error: function () {

            }
        }); // end ajax call
    }

    function levelUp(type) {
        $.ajax({
            url: "levelUp?type="+type+"&user=" + $('#user').val(),
            type: 'get',

            success: function (data) {
                update();
            },
            error: function () {

            }
        }); // end ajax call
    }

    function attack(id) {
        $.ajax({
            url: "attack?defender="+id+"&user=" + $('#user').val(),
            type: 'get',

            success: function (data) {
                update();
            },
            error: function () {

            }
        });

    }




</script>