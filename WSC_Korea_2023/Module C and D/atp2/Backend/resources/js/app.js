import "./bootstrap";

const searchBar = document.getElementById("game-search");
const games = document.querySelectorAll(".game-row");

searchBar.addEventListener("input", () => {
    let value = searchBar.value;

    for (let i = 0; i < games.length; i++) {
        if (
            games[i]
                .querySelector(".game-title")
                .innerText.toLowerCase()
                .includes(value.toLowerCase())
        ) {
            games[i].style.display = "table-row";
        } else {
            games[i].style.display = "none";
        }
    }
});
