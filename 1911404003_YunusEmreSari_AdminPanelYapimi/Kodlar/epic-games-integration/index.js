// const puppeteer = require("puppeteer-extra")
// const {executablePath} = require('puppeteer')

// function delay(time) {
//     return new Promise(function(resolve) { 
//         setTimeout(resolve, time)
//     });
//  }

async function start(){


    // const browser = await puppeteer.launch({
    //     args: ['--no-sandbox',],
    //     headless: false,
    //     ignoreHTTPSErrors: true,
    //     // add this
    //     executablePath: executablePath(),
    // })
    // const page = await browser.newPage()
    // await page.goto("https://store.epicgames.com/en-US/p/the-callisto-protocol")
    // // That's it, a single line of code to solve reCAPTCHAs 🎉
    // await delay(1000);

    // if (await page.$(".css-1a6we1t") !== null)
    // {
    //     await page.click(".css-1a6we1t")
    // }    
    

    // // const clickedData = await page.$eval(".css-10mlqmn",el => el.textContent)
    // const clickedData = await page.$eval(".css-3r3brs",el => el.textContent)

    // console.log(clickedData)
    
    // //Multiple Elements
    // // const clickedData = await page.$$eval(".css-10mlqmn",(args) => {
    // //     return args.map(x => x.textContent)
    // // })

    // // for (const arg of clickedData) {
    // //     console.log(arg)        
    // // }
    
    

    // // await page.screenshot({path:"doom-3.png"})








    

    endpoint = "https://graphql.epicgames.com/graphql"

    const params = { 
        "operationName":"getCatalogOffer",
        "variables":{"locale":"en-US","country":"US","offerId":"3a2cd39b48334ce2b3e2b21fd59bae90","sandboxId":"3f7f2afed90845d4969708fe3da99e4a"},
        "extensions":{"persistedQuery":{"version":1,"sha256Hash":"6797fe39bfac0e6ea1c5fce0ecbff58684157595fee77e446b4254ec45ee2dcb"}}
        };

    fetch("https://store.epicgames.com/graphql?operationName="+params["operationName"]+"&variables=%7B%22locale%22:%22"+params["variables"]["locale"]+"%22,%22country%22:%22"+params["variables"]["country"]+"%22,%22offerId%22:%22"+params["variables"]["offerId"]+"%22,%22sandboxId%22:%22"+params["variables"]["sandboxId"]+"%22%7D&extensions=%7B%22persistedQuery%22:%7B%22version%22:1,%22sha256Hash%22:%22"+params["extensions"]["persistedQuery"]["sha256Hash"]+"%22%7D%7D", {
        "referrerPolicy": "no-referrer-when-downgrade",
        "body": null,
        "method": "GET",
        "mode": "cors",
        "credentials": "include"
      })
    .then(response => response.json())
    .then(response => console.log(JSON.stringify(response)))

    }

start() 







// //Get Yöntemi

// import XMLHttpRequest from 'xhr2';

// function getUser() {
//   const xhttp = new XMLHttpRequest();
//   xhttp.onreadystatechange = function logger() {
//     if (this.readyState === 4 && this.status === 200) {
//       console.log(this.responseText);
//     }
//   };
//   xhttp.open('GET', 'https://store-content-ipv4.ak.epicgames.com/api/en-US/content/products/the-callisto-protocol', true);
//   xhttp.send();
// }

// getUser();







