// import getGameOffers from './get-epic-game-prices.js';

var index = 1;

let SortBy;
let SortDir;
let Categories;
let params;


async function findEpicFreeGames(){

  //sha-256 hashes
  //7d58e12d9dd8cb14c84a3ff18d360bf9f0caa96bf218f2c5fda68ba88d68a437

  var hashes = ["7d58e12d9dd8cb14c84a3ff18d360bf9f0caa96bf218f2c5fda68ba88d68a437","13a2b6787f1a20d05c75c54c78b1b8ac7c8bf4efc394edf7a5998fdf35d1adb0"];
  // var hashes = ["13a2b6787f1a20d05c75c54c78b1b8ac7c8bf4efc394edf7a5998fdf35d1adb0"];
  var index = Math.floor(Math.random() * hashes.length);

  return await fetch("https://store.epicgames.com/graphql?operationName=searchStoreQuery&variables=%7B%22allowCountries%22:%22US%22,%22category%22:%22"+params["categories"]+"%22,%22comingSoon%22:false,%22count%22:"+params["count"]+",%22country%22:%22US%22,%22freeGame%22:true,%22keywords%22:%22"+params["searchWords"]+"%22,%22locale%22:%22en-US%22,%22sortBy%22:%22"+params["sortBy"]+"%22,%22sortDir%22:%22"+params["sortDir"]+"%22,%22start%22:"+params["start"]+",%22tag%22:%22%22,%22withPrice%22:true%7D&extensions=%7B%22persistedQuery%22:%7B%22version%22:1,%22sha256Hash%22:%22"+hashes[index]+"%22%7D%7D", {
    "headers": {
      "accept": "application/json, text/plain, */*",
      "x-requested-with": "XMLHttpRequest",

    },
    "referrerPolicy": "no-referrer-when-downgrade",
  })
  .then(response => response.json())
  .then(function(response){

    console.log(JSON.stringify(response));

  })


}


// function noResultReturn(searchAppName,steamAppId){

//   let result = {
//     "no-result":steamAppId
//     // "appName":searchAppName,
//     // "steamAppId":steamAppId,
//   }
//   // dataArray.push(result);
//   // console.log(JSON.stringify(dataArray));

//   return result;
// }

export default function setAppProperties(){

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
    "categories":Categories.Games,
    "start":0,
    "count":100,
    "sortBy":SortBy.Relevancy,
    "sortDir":SortDir.DESC,
  };

  console.log("Çalıştı");
}

// export{setAppProperties};
setAppProperties();
findEpicFreeGames();
