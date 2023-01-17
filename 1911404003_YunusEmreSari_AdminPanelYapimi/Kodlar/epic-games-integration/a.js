import findGameIdWithName from './find-epic-games.js';


export default async function getSteamGames(isLatest){


  var url = "";
  if(isLatest){
    url = "http://localhost/GameShopping/admin/steam_games.php?filter=standard_only&isLatest=1";
  }
  else{
    url="http://localhost/GameShopping/admin/steam_games.php?filter=standard_only";
  }

    fetch(url, {
        "headers": {
          "accept": "application/json, text/plain, */*",
          "x-requested-with": "XMLHttpRequest"
        },
        "body": null,
        "method": "GET",
        "mode": "cors",
        "credentials": "include"
      })
      .then(function(response) {
        return response.json()
      }).then(function (data) {

        var keys = [];
        for (var x in data) {
          keys.push(x);
        }
        
        // var text = data[keys[54]];
        var text = data[keys[348]];
        text = text.replaceAll("®","");
        // console.log(text);
        text = encodeURIComponent(text);
        text = text.replaceAll("\'","%27");
        text = text.replaceAll("%20","+");
        console.log(text);
        // console.log("Sid+Meier%27s+Civilization+V");
        console.log("Stubbs+the+Zombie+in+Rebel+Without+a+Pulse");

        //Sid%20Meier's%20Civilization%20V
        //Sid+Meier%27s+Civilization+V

        // console.log(encodeURIComponent("Sid Meier's Civilization V"));

        // for (let index = 0; index < 2; index++) {
        //   const element = keys[index];
        //   // console.log(element);
        // }

      })

}

getSteamGames(false);


