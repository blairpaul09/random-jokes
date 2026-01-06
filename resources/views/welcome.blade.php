<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        .container{
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 24px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="form">
            <p id="unauthorized"></p>
            <input type="email" value="john.doe@example.com" id="email" placeholder="email"> </br> </br>
            <input type="password" value="password" id="password" placeholder="password"> </br> </br>
            <button type="button" onclick="login()">login</button>
        </div>
        <div id="user">

        </div>
        <div>
            <ul id="jokes">
                <li>Login to read some jokes!</li>
            </ul>
            <button onclick="loadJokes()">Refresh</button>
        </div>
    </div>
</body>
</html>

<script>
let accessToken = null;
let user = null;
const jokesHtml = document.getElementById('jokes');

async function login() {
  const email = document.getElementById('email').value
  const password = document.getElementById('password').value

  try {
    const res = await fetch('/api/auth/login', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        email,
        password
      })
    })

    const data = await res.json()
    if (!res.ok) {
      throw new Error(data.message)
    }

    const responseData = data.data;

    accessToken = responseData.access_token;
    user = responseData.user;

    const userDoc = document.getElementById('user');
    const form = document.getElementById('form');

    form.remove();

    const userHtml = `
        <p>Hello ${user.name}, how are you?</p>
        <p> I hope I will make your day by reading my jokes!</p>
    `;

    userDoc.innerHTML = userHtml;

    loadJokes();

  } catch (err) {
    const errorMessage = document.getElementById('unauthorized');
    errorMessage.innerHTML = err;
  }
}

async function loadJokes() {

    if(!accessToken){
        jokesHtml.innerHTML = '<li>Pleas login first!</li>';
        return;
    }

  try {
    jokesHtml.innerHTML = '';

    const res = await fetch('/api/random-jokes', {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Authorization': `Bearer ${accessToken}`
      },
    })

    const data = await res.json()

    if (!res.ok) {
      throw new Error(data || 'Login failed')
    }

    const jokes = data.data;

    jokes.forEach(joke => {
        const item = `
            <li>
                <p>Type: ${joke.type}</p>
                <p>Setup: ${joke.setup}</p>
                <p>Punchline: ${joke.punchline}</p>
            </li>
        `;

        jokesHtml.insertAdjacentHTML('beforeend', item);
    });

  } catch (err) {
    console.error(err);
  }
}
</script>
