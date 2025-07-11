
export async function upvote(event) {

	const button = event.currentTarget; 
	const newsId = button.dataset.idNews;
	
  try {
		const response = await fetch("/tutorial/index.php/news/vote/" + newsId, { 
			method: "POST",
      headers: {
				"Content-Type": "application/json",
      },
      body: JSON.stringify({value: 1 }) 
    });

			if (response.status === 401) {
					mensajeLogin("Debes iniciar sesión para votar.");
					return;
			}
		
    const data = await response.json(); 
		
    console.log("Voto positivo registrado", data);
    updateStyles(1); 
  } catch (error) {
		console.error("Error al enviar voto positivo", error);
  }
}


export async function downvote(event) {

	const button = event.currentTarget; 
	const newsId = button.dataset.idNews;

  try {
		const response = await fetch("/tutorial/index.php/news/vote/" + newsId, {
			method: "POST",
      headers: {
				"Content-Type": "application/json",
      },
      body: JSON.stringify({value: -1 }) 					
    });

		if (response.status === 401) {
					mensajeLogin("Debes iniciar sesión para votar.");
					return;
			}
			
    const data = await response.json(); 		
		
    console.log("Voto negativo registrado", data);
    updateStyles(-1); 			
  } catch (error) {
		console.error("Error al enviar voto negativo", error);
  }
}




function updateStyles(vote) {
	const up = document.getElementById("upvote");
	const down = document.getElementById("downvote");

	up.classList.remove("click-up");
	down.classList.remove("click-down");

	if (vote === 1) {
		up.classList.add("click-up");
	} else if (vote === -1) {
		down.classList.add("click-down");
	}
}

function mensajeLogin(texto) {
  const mensaje = document.getElementById("mensaje-login");
  mensaje.textContent = texto;
}
