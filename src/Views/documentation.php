<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentation</title>
</head>
<body>

<div class="wrapper">
    <h1>Dokumenation</h1>
    <p><b>Server expects an API Key (type = string) to connect</b></p>
    headers: {
    'Content-Type': 'application/json',
    'API-Key': apiKey
    }
    <h2>Endpoints</h2>
    <h3>POST</h3>
    <p><b>api/wishlists/add</b></p>
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
    <p><b>api/wish/add</b></p>
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
    <h3>GET</h3>
    <p><b>api/wishlist/{uuid}</b></p>
    Retrieves the wishlist {uuid}
    <p><b>api/wishes/{wishlist_uuid}</b></p>
    Retrieves all wishes for the {wishlist_uuid}
    <p><b>api/wish/delete/{id}</b></p>
    Deletes the wish {id}
</div>

<style>
    body {
        font-family: 'Gill Sans Nova';
    }

    .wrapper {
        max-width: 1450px;
        position: relative;
        margin: 0 auto;
        padding: 0 20px;
    }
</style>


</body>
</html>