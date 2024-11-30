const canvas = document.getElementById("canvas");
const ctx = canvas.getContext("2d");

canvas.height = window.innerHeight;
canvas.width = window.innerWidth;

function drawBubble(a, b) {
  const radius = 10 * Math.random();
  const color = `rgba(${Math.random() * 255}, ${Math.random() * 255}, ${
    Math.random() * 255
  }, 1)`;
  ctx.beginPath();
  ctx.arc(a, b, radius, 0, 2 * Math.PI);
  ctx.fillStyle = color;
  ctx.fill();
  ctx.stroke();
}

function handleClickOnCanvas () {
  const a = 1920 * Math.random();
  const b = 1080 * Math.random();
  animate(a, b);
}

function animate (a , b) {
  drawBubble(a , b);
  requestAnimationFrame(animate);
}
let interval1 = setInterval(handleClickOnCanvas, 70);

setTimeout(() => {
  clearInterval(interval1);
}, 120000);

animate();
