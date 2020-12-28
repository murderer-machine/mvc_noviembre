import React, { useState } from 'react'
import ReactDOM from 'react-dom'
const Cupones = () => {
    const [comentarios, setComentarios] = useState([
        {
            id: 1,
            nombres: 'marco rodriguez',
            comentarios_list: [{
                comentario: 'comentario1'
            }, {
                comentario: 'comentario2'
            }]
        }, {
            id: 2,
            nombres: 'pamela rodriguez',
            comentarios_list: [{
                comentario: 'comentario1'
            }, {
                comentario: 'comentario2'
            }]
        },
    ])
    const updateItem = (i) => {
        let copy = [...comentarios]
        copy[i].comentarios_list.push({
            comentario: 'comentario3'
        })
        setComentarios(copy)

    }
    return <>
        {comentarios.map((element, i) => (
            <>
                <p>{element.id}</p>
                <p>{element.nombres}</p>
                <button onClick={() => { updateItem(i) }}>Agregar</button>
                {element.comentarios_list.map((comentario, i_) => (
                    <>
                        <p>{comentario.comentario}</p>
                    </>
                ))}
                <hr />
            </>
        ))}
        {JSON.stringify(comentarios)}
    </>
}

export default Cupones
if (document.getElementById("cupones")) {
    const element = document.getElementById('cupones')
    const props = Object.assign({}, element.dataset)
    ReactDOM.render(<Cupones {...props} />, element)

}