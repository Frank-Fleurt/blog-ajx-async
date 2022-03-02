const postContainer = document.querySelector(".postContainer");
const form = document.getElementById("post");

const createPost = (data) => {
  postContainer.innerText = "";

  let post = document.createAttribute("div");
  post.classList.add("post");

  post.innerHTML = `
    <h3>${data.title}</h3>
    <p>${data.content}</p>
    <span>Créer le ${data.date} par ${data.author}</span>
  `;
  post.postContainer.appendChild(post);
};

const display = async () => {
  const tata = await fetch("./traitement.php");

  const response = await tata.json();

  console.log(response);
};
display();

form.addEventListener("submit", async (e) => {
  e.preventDefault();

  const data = new FormData(form);
  const response = await fetch("./traitement.php", {
    method: "POST",
    body: data,
  });

  const res = await response.json();
  if (response.satuts === "ok") {
    const resData = await response.json();
    createPost(resData);
  }
});
