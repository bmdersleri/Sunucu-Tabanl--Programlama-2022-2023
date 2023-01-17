 
 async function getAllGames(){

    fetch("http://localhost/GameShopping/admin/epic_games.php", {
        "headers": {
          "accept": "application/json, text/plain, */*",
          "x-requested-with": "XMLHttpRequest"
        },
        "body": null,
        "method": "GET",
        "mode": "cors",
        "credentials": "include"
      })
      .then(function(response) 
      {
        return response.json()
      })
      .then(function (data) 
      {
        adjustGettingAppOffers(data)
      })

}

function adjustGettingAppOffers(data){
  
  for (let index = 0; index < data.length; index++) {
      var appId = data[index]["epic_app_id"];
      var sandboxId = data[index]["epic_sandbox_id"];
      // console.log("App Id: "+appId+" Sandbox Id: "+sandboxId);
      getGameOffers(appId,sandboxId);
  }
}

export default async function getGameOffers(appId,sandboxId){

  const endpoint = "https://graphql.epicgames.com/graphql"

  const params = { 
    "operationName":"getCatalogOffer",
    "variables":{"locale":"en-US","country":"US","offerId":appId,"sandboxId":sandboxId},
    "extensions":{"persistedQuery":{"version":1,"sha256Hash":"6797fe39bfac0e6ea1c5fce0ecbff58684157595fee77e446b4254ec45ee2dcb"}}
  };

  // var hashes = ["7d58e12d9dd8cb14c84a3ff18d360bf9f0caa96bf218f2c5fda68ba88d68a437","13a2b6787f1a20d05c75c54c78b1b8ac7c8bf4efc394edf7a5998fdf35d1adb0"];
  // var index = Math.floor(Math.random() * hashes.length);

  fetch("https://store.epicgames.com/graphql?operationName="+params["operationName"]+"&variables=%7B%22locale%22:%22"+params["variables"]["locale"]+"%22,%22country%22:%22"+params["variables"]["country"]+"%22,%22offerId%22:%22"+params["variables"]["offerId"]+"%22,%22sandboxId%22:%22"+params["variables"]["sandboxId"]+"%22%7D&extensions=%7B%22persistedQuery%22:%7B%22version%22:1,%22sha256Hash%22:%22"+params["extensions"]["persistedQuery"]["sha256Hash"]+"%22%7D%7D", {
      "referrerPolicy": "no-referrer-when-downgrade",
      "body": null,
      "method": "GET",
      "mode": "cors",
      "credentials": "include"
    })
  .then(response => response.json())
  .then(function(response){

      var title = response["data"]["Catalog"]["catalogOffer"]["title"];
      var discountPrice = parseFloat(splitPriceString(response["data"]["Catalog"]["catalogOffer"]["price"]["totalPrice"]["discountPrice"].toString()));
      var initialPrice = parseFloat(splitPriceString(response["data"]["Catalog"]["catalogOffer"]["price"]["totalPrice"]["originalPrice"].toString()));
      var discount = parseFloat(splitPriceString(response["data"]["Catalog"]["catalogOffer"]["price"]["totalPrice"]["discount"].toString()));
      var discountPercent = (discount*100 / initialPrice).toString().substring(0,2);
      var currency = response["data"]["Catalog"]["catalogOffer"]["price"]["totalPrice"]["currencyCode"];
      var allTags = response["data"]["Catalog"]["catalogOffer"]["tags"];
      var epicAppUrl = "https://store.epicgames.com/en-US/p/"+response["data"]["Catalog"]["catalogOffer"]["catalogNs"]["mappings"][0]["pageSlug"];

      var isFreeToPlay = false;

      for (let index = 0; index < allTags.length; index++) {
        if(allTags[index]["name"].includes("Free"))
        {
          //Free to play olduğu için bunu kaydetmiyoruz
          console.log("Free To Play "+title);
          isFreeToPlay = true;
          return;
        }
      }

      if(!isFreeToPlay && discountPrice == 0){
        //Oyun henüz epic games e gelmemiş
        console.log("Oyun Henüz Epic Games e Gelmemiş. "+title);
        return;
      }

      // console.log(title + " Initial Price: "+initialPrice+" TRY Discount Price: "+discountPrice +" "+currency+" DiscountPercent: "+discountPercent);
      // console.log("--------------------------------------------------------------------------------")
      var dataArray = [];

      let result = {
        "game_epic_app_id":appId,
        "game_epic_sandbox_id":sandboxId,
        "price_currency":currency,
        "price_initial":initialPrice,
        "price_final":discountPrice,
        "price_discount_percent":discountPercent,
        "game_url":epicAppUrl,
      }
    
      dataArray.push(result);

      if(dataArray.length > 0)
        console.log(JSON.stringify(dataArray));

  })


}


function splitPriceString(price){
  
  const lastPart = /\d{0,2}$/g;
  const firstPart = /\d{0,}(?=\d{2})/g;

  if(price == 0)
  return 0;
  else
  return price.match(firstPart)[0]+"."+price.match(lastPart)[0];
}

export{getGameOffers};

getAllGames();
// getGameOffers("529b04a9c9094cc4b87e9149c4726fc0","f4a7772a4da24870a3ea6dfb8aeac662");//Borderland 2
// getGameOffers("09176f4ff7564bbbb499bbe20bd6348f","fn");//Rocket League
