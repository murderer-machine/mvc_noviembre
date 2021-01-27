import React from 'react'
import ReactDOM from 'react-dom'
import Menu from '../menu/menu_horizontal'
const Inicio = () => {
    return (
        <Menu modulo="inicio">
           
        </Menu>
    )
}
export default Inicio;
if (document.getElementById("inicio")) {
    ReactDOM.render(<Inicio />, document.getElementById("inicio"));
}