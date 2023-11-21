document.addEventListener("DOMContentLoaded", () => {
    initAddWishlist();
    initAddWish();
    initDeleteWish();
    initGetWishlist();
    initGetWishes();
})

const initAddWishlist = () => {
 
    const button = document.querySelector('#submit');
    button.addEventListener("click", async () => {
        const title = document.querySelector("input[name='title']").value;
        const description = document.querySelector("input[name='description']").value; 
        addWishlist(title, description);
    });
}

const addWishlist = async (title, description) => {
    const url = "https://timothy.marketport.site/api/wishlist/add";
    const method = "POST";
    const apiKey = '9dRd7iPqLCh,"tKoF!lxZ3#-]';
    const data = {
        title,
        description
    }

    const request = fetch(url, {
        'method': method,
        headers: {
            'Content-Type': 'application/json',
            'API-Key': apiKey
        },
        body: JSON.stringify(data)
    })

    const response = await request;
    console.log(response.status);

}

const initAddWish = () => {

    const button = document.querySelector('#submit-new-wish');
  
    button.addEventListener("click", async () => {
        const title = document.querySelector("#wish-title").value;
        const description = document.querySelector("#wish-description").value;
        const wishlist_uuid = "3ba0ed1e-d17d-4618-bc87-08020bc8ee42";
        addWish(title, description, wishlist_uuid);
    });
  }

  const addWish = async (title, description, wishlist_uuid) => {
    const url = "https://timothy.marketport.site/api/wish/add";
    const method = "POST";
    const apiKey = '9dRd7iPqLCh,"tKoF!lxZ3#-]';
    const data = {
        title,
        description,
        wishlist_uuid
    }

    const request = fetch(url, {
        'method': method,
        headers: {
            'Content-Type': 'application/json',
            'API-Key': apiKey
        },
        body: JSON.stringify(data)
    })

    const response = await request;
    console.log(response.status);
}



const initGetWishlist = () => {

    const button = document.querySelector('#getit');
    const uuid = "3ba0ed1e-d17d-4618-bc87-08020bc8ee42";

    button.addEventListener("click", async () => {
      getWishlist(uuid);
    });
  }
  
  const getWishlist = async (uuid) => {
      const url = `https://timothy.marketport.site/api/wishlist/${uuid}`;
      const method = "GET";
      const apiKey = '9dRd7iPqLCh,"tKoF!lxZ3#-]';
    
      const request = fetch(url, {
          'method': method,
          headers: {
              'Content-Type': 'application/json',
              'API-Key': apiKey
          }
      })
  
      const response = await request;
      const response_data = await response.json();
      console.log(response_data);
  }

  const initGetWishes = () => {

    const button = document.querySelector('#getwishes');
    const wishlist_uuid = "3ba0ed1e-d17d-4618-bc87-08020bc8ee42";

    button.addEventListener("click", async () => {
      getWishes(wishlist_uuid);
    });
  }
  
  const getWishes = async (wishlist_uuid) => {
      const url = `https://timothy.marketport.site/api/wishes/${wishlist_uuid}`;
      const method = "GET";
      const apiKey = '9dRd7iPqLCh,"tKoF!lxZ3#-]';
    
  
      const request = fetch(url, {
          'method': method,
          headers: {
              'Content-Type': 'application/json',
              'API-Key': apiKey
          }
      })
  
      const response = await request;
      const response_data = await response.json();
      console.log(response_data);;
  }

  const initDeleteWish = () => {

    const button = document.querySelector('#delete-item-button');

    button.addEventListener("click", async () => {
        const id = parseInt(document.querySelector('#delete-item').value);
        deleteWish(id);
    });
  }

  const deleteWish = async (id) => {
        const url = `https://timothy.marketport.site/api/wish/delete/${id}`;
        const method = "GET";
        const apiKey = '9dRd7iPqLCh,"tKoF!lxZ3#-]';
  

    const request = fetch(url, {
        'method': method,
        headers: {
            'Content-Type': 'application/json',
            'API-Key': apiKey
        }
    })

    const response = await request;
    console.log(response.status)
}