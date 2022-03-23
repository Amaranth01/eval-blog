const img = document.getElementById('carousel');
let pictures = ['https://wallup.net/wp-content/uploads/2019/09/103612-dragon-dragons-fire-battle-warrior.jpg',
    'https://wallpapertag.com/wallpaper/full/d/b/0/451289-chinese-dragon-wallpaper-1920x1080-for-android-50.jpg',
    'http://3.bp.blogspot.com/-1iTt4KRQ8Fg/VOMxXLSD5GI/AAAAAAAAKiA/zUX0zg1QS1M/s1600/dragons-krokmou.jpg'];

let j = 0;
let position = 0;

img.src = pictures[0];

const moveRight = () => {
    if (position >= pictures.length - 1) {
        position = 0
        img.src = pictures[position];
        return;
    }
    img.src = pictures[position + 1];
    position++;
}
setInterval(function () {
    j++;
    moveRight()
}, 6000);