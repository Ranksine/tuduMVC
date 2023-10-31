let menuItems=[];

menuItems.push(document.getElementById("por-continente"));
menuItems.push(document.getElementById("por-pais"));

let path=window.location.pathname;

console.log("Path actual: " + path);

let ultimaRuta = path.lastIndexOf("/");

path = path.substring(ultimaRuta+1);

console.log("Path modificadini: " + path);


switch (path) {
    case 'por-continente':        
        menuItems[0].children[0].classList.add("active");
        // menuItems[0].classList.add("active");
        break;

    case 'por-pais':
        menuItems[1].children[0].classList.add("active");
        // menuItems[1].classList.add("active");        
        break;

    default:
        break;
}