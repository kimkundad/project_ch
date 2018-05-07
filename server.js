var socket  = require( './public/node_modules/socket.io' );
var express = require('./public/node_modules/express');
var mysql = require('./public/node_modules/mysql');
var bodyParser = require('./public/node_modules/body-parser');
var app = express();
var fs = require('fs');

var options = {
    key: fs.readFileSync('./public/certificates/learnsbuy.com.key'),
    cert: fs.readFileSync('./public/certificates/learnsbuy.com.chained.crt'),
  //  requestCert: true
};


var server  = require('https').createServer(options, app);
var io      = socket.listen( server );
var port    = process.env.PORT || 3000;

var con = mysql.createConnection({
  host: "127.0.0.1",
  user: "root",
  password: "mysql",
  database: "enihongo"
});


var sendNotification = function(data) {
  var headers = {
    "Content-Type": "application/json; charset=utf-8",
    "Authorization": "Basic NGEwMGZmMjItY2NkNy0xMWUzLTk5ZDUtMDAwYzI5NDBlNjJj"
  };

  var options = {
    host: "onesignal.com",
    port: 443,
    path: "/api/v1/notifications",
    method: "POST",
    headers: headers
  };

  var https = require('https');
  var req = https.request(options, function(res) {
    res.on('data', function(data) {
      console.log("Response:");
      console.log(JSON.parse(data));
    });
  });

  req.on('error', function(e) {
    console.log("ERROR:");
    console.log(e);
  });

  req.write(JSON.stringify(data));
  req.end();
};


app.use(bodyParser.json()); // support json encoded bodies
app.use(bodyParser.urlencoded({ extended: true })); // support encoded bodies

app.post('/index_2', function (req, res) {

  con.connect(function(err) {

    var user_id = req.body.user_id;
    var name = req.body.name;
    var message_in = req.body.message_in;
    var playerid = req.body.playerid;
    var provider = req.body.provider;
    var avatar = req.body.avatar;

  console.log("Connected!");

  var sqlcheck = "SELECT * FROM messages where chat_user_id = " + user_id + " and seen = 0";
  var check_noti = 0;
  con.query(sqlcheck, function(err, resultcheck) {
      if(resultcheck.length > 0){
        check_noti = 1;
      }else{
        check_noti = 0;
      }

      io.sockets.emit( 'new_count_message', {
      	new_count_message: resultcheck.length

      });


  });


  var sql = "INSERT INTO messages (chat_user_id, agent_id, message,	seen, created_at, updated_at) VALUES (" + user_id + ", 1, '" + message_in + "',0, NOW(), NOW())";
  con.query(sql, function (err, result) {
    if (err) throw err;
    console.log(name);
    var date = new Date();


      io.sockets.emit( 'new_message', {
        timer: date,
        name: name,
        avatar: avatar,
        provider: provider,
        check_noti: check_noti,
        chat_user_id: user_id,
        message_in: message_in,
        agent_id: 1,
        playerid: playerid
      });


      var message_string = String(message_in);

      var message = {
        app_id: "ffd631de-5f47-4069-9a7a-b49087ea0341",
        contents: {"en": message_string},
        include_player_ids: [playerid]
      };
      sendNotification(message_in);


    /*  app.post('/newuser', function (req, res) {
          var json = req.body; 'status'=>200, 'message' => 'register success', 'data' => true
          res.send('Add new ' + json.name + ' Completed!');
      }); */

res.json({'status' : 200, 'message' : message_in, 'data' : true});

  });
});

  //  res.send('<h1>1 record inserted</h1>');
});

server.listen(port, function () {
  console.log('Server listening at port %d', port);
});


io.on('connection', function (socket) {

  socket.on( 'new_count_message', function( data ) {
    io.sockets.emit( 'new_count_message', {
    	new_count_message: data.new_count_message

    });
  });

  socket.on( 'update_count_message', function( data ) {
    io.sockets.emit( 'update_count_message', {
    	update_count_message: data.update_count_message
    });
  });

  socket.on( 'new_message', function( data ) {

    var message_string =  data.message_in.toString();

    var message = {
          app_id: "ffd631de-5f47-4069-9a7a-b49087ea0341",
          headings : {"en": data.name+" ส่งข้อความถึงคุณ"},
          contents: {"en": message_string},
          include_player_ids: [data.playerid],
          ios_badgeType : "Increase",
          ios_badgeCount : 1
        };

  /*  var message = {
      app_id: "ffd631de-5f47-4069-9a7a-b49087ea0341",
      contents: {"en": message_string},
      include_player_ids: [data.playerid],
      ios_badgeType : "Increase",
      ios_badgeCount : 1
    }; */
    sendNotification(message);


    io.sockets.emit( 'new_message', {
      timer: data.timer,
      name: data.name,
      avatar: data.avatar,
      provider: data.provider,
      check_noti: data.check_noti,
      chat_user_id: data.chat_user_id,
      message_in: data.message_in,
      agent_id: data.agent_id,
      playerid:data.playerid
    });
  });


});
