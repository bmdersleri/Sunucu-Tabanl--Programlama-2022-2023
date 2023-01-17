import stringSimilarity from 'string-similarity';
// import getGameOffers from './get-epic-game-prices.js';

var index = 1;

let SortBy;
let SortDir;
let Categories;
let params;

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

        console.time("timer1");
        adjustFinding(data).then((result) => {
          
          
          console.log(JSON.stringify(result));
          // console.timeEnd("timer1");

          //  console.log(result[0]);

          //  getGameOffers(result[0]["epicAppId"],result[0]["epicSandboxId"]);
        })


      })

}

async function adjustFinding(data){

  var dataArray = [];
  // console.time("timer1");

  // return new Promise((resolve,reject) => {


  // })
  var $i = 0;
  for (var name in data) {

    const re = /(\w{0,})(?=edition|base)/g;
    const myArray = name.match(re);
    const steamAppId = myArray[0];

    if(name.includes("edition"))
    {
      await findGameIdWithName(data[name],"Edition",steamAppId)
      .then((result) => {
        dataArray.push(result);
      })
    }
    else
    {
      await findGameIdWithName(data[name],"Standard",steamAppId)
      .then((result) => {
        dataArray.push(result);
      })
    }

    // $i++;
    // if($i == 50)
    // break;
  }
  // console.log(dataArray[0]);

  // console.timeEnd("timer1");

  return dataArray;

}


async function findGameIdWithName(searchAppName,edition,steamAppId){

  // console.log("Edition: "+edition+" App: "+searchAppName);

  searchAppName = searchAppName.replace("®","");

  if(edition == "Standard")
  {
    params["categories"] = Categories.Games;
  }

  params["searchWords"] = encodeURIComponent(searchAppName);

  var hashes = ["7d58e12d9dd8cb14c84a3ff18d360bf9f0caa96bf218f2c5fda68ba88d68a437","13a2b6787f1a20d05c75c54c78b1b8ac7c8bf4efc394edf7a5998fdf35d1adb0"];
  var index = Math.floor(Math.random() * hashes.length);

  return await fetch("https://store.epicgames.com/graphql?operationName=searchStoreQuery&variables=%7B%22allowCountries%22:%22US%22,%22category%22:%22"+params["categories"]+"%22,%22comingSoon%22:false,%22count%22:"+params["count"]+",%22country%22:%22US%22,%22keywords%22:%22"+params["searchWords"]+"%22,%22locale%22:%22en-US%22,%22sortBy%22:%22"+params["sortBy"]+"%22,%22sortDir%22:%22"+params["sortDir"]+"%22,%22start%22:"+params["start"]+",%22tag%22:%22%22,%22withPrice%22:true%7D&extensions=%7B%22persistedQuery%22:%7B%22version%22:1,%22sha256Hash%22:%22"+hashes[index]+"%22%7D%7D", {
    "headers": {
      "accept": "application/json, text/plain, */*",
      "x-requested-with": "XMLHttpRequest"
    },
    "referrerPolicy": "no-referrer-when-downgrade",
  })
  .then(response => response.json())
  .then(function(response){

    // console.log(response);
    // console.log("Edition: "+edition+" App: "+searchAppName);

    if(response == null || response["errors"])
    {
      return (noResultReturn(searchAppName,steamAppId));
    }

    const elements = response["data"]["Catalog"]["searchStore"]["elements"];

    if(elements.length == 0)
    {
      return (noResultReturn(searchAppName,steamAppId));
    }

    const appName = elements[0]["title"];
    const epicAppId = elements[0]["id"];
    const epicSandboxId = elements[0]["namespace"];
    const epicAppUrl = "https://store.epicgames.com/en-US/p/"+elements[0]["catalogNs"]["mappings"][0]["pageSlug"];

    let result = {
      "appName":appName,
      "steamAppId":steamAppId,
      "epicAppId":epicAppId,
      "epicSandboxId":epicSandboxId,
      "epicAppUrl":epicAppUrl
    }

    if(!similarity(searchAppName,appName)){
      return (noResultReturn(searchAppName,steamAppId));
    }
    // console.log(index+"----------------");
    index++;

    return result;

  })


}


function similarity(str1,str2){
  var similarity = stringSimilarity.compareTwoStrings(str1, str2);
  // console.log("Similarity: "+similarity+ " ------------ "+ str1+" -- VS -- "+str2);

  if(similarity >= 0.625)
  {
    return true;
  }
  else{
    return false;
  }
}


function noResultReturn(searchAppName,steamAppId){

  let result = {
    "no-result":steamAppId
    // "appName":searchAppName,
    // "steamAppId":steamAppId,
  }
  // dataArray.push(result);
  // console.log(JSON.stringify(dataArray));

  return result;
}

function setAppProperties(){

  SortBy = {
    RelaseDate:"releaseDate",
    ComingSoon:"comingSoon",
    Title:"title",
    Relevancy:"relevancy",
    CurrentPrice:"currentPrice"
  }

  SortDir = {
    ASC:"ASC",
    DESC:"DESC"
  }

  Categories = {
    Games:"games/edition/base|",
    GameBundle:"bundles/games|",
    GameEdition:"games/edition|",
    GameAddOn:"addons|",
    Editor:"editors|",
    GameDemo:"games/demo|",
    Apps:"software/edition/base|",
  }

  Categories = Object.assign(Categories, {
    All:Categories.Games+Categories.GameBundle+Categories.GameEdition+Categories.GameAddOn+Categories.Editor+Categories.GameDemo+Categories.Apps
  })

  // console.log(searchAppName);

  params = {
    "operationName":"searchStoreQuery",
    "searchWords":"",
    "country":"US",
    "categories":Categories.GameEdition,
    "start":0,
    "count":1,
    "sortBy":SortBy.Relevancy,
    "sortDir":SortDir.DESC,
  };

}

setAppProperties();
// getSteamGames();

// findGameIdWithName("Just Cause 4","Standard","6880")
// .then((result) => {
//   console.log(result);
// })

export{findGameIdWithName};