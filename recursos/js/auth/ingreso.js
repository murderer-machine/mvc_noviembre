import React, { useState, version } from 'react'
import ReactDOM from 'react-dom'
import { Form, Container, Row, Col, Image } from 'react-bootstrap'
import TextField from '@material-ui/core/TextField'
import Button from '@material-ui/core/Button'
import AppBar from '@material-ui/core/AppBar'
import Toolbar from '@material-ui/core/Toolbar'
import Checkbox from '@material-ui/core/Checkbox'
import FormControlLabel from '@material-ui/core/FormControlLabel'

import './ingreso.scss'
const Ingreso = () => {
    const [datos, setDatos] = useState({
        dni: '',
        password: '',
        recordar: false,
    })
    const [datos_verificado, setDatos_verificado] = useState({
        dni: true,
        password: true,
    })
    const [variante, setVariante] = useState({
        style: '',
        mensaje: '',
    });
    const handleInputChange = (event) => {
        const { type, checked, name, value } = event.target
        setDatos({
            ...datos,
            [name]: type === 'checkbox' ? checked : value
        })
    }
    const Verificar = (event) => {
        let dni = datos.dni === '' ? false : true
        let password = datos.password === '' ? false : true
        setDatos_verificado({
            dni: dni,
            password: password,
        })
        return dni && password
    }
    const enviarDatos = (event) => {
        event.preventDefault()
        if (Verificar()) {
            var url = `/login`
            fetch(url, {
                method: 'POST',
                body: JSON.stringify(datos),
                headers: {
                    'Content-Type': 'application/json'
                }
            }).then(res => res.json())
                .catch(error => console.error('Error:', error))
                .then(response => {
                    response === 1 ? (window.location.href = `/ejemplo`) : {}
                })
        }
    }
    return (
        <>
            <Container>
                <AppBar position="fixed" color="transparent" elevation={0}>
                    <Toolbar>
                        <Image
                            className="logo_horizontal m-3"
                            src={`/img/logo_horizontal.svg`}
                            alt="logo_horizontal"
                        />
                    </Toolbar>
                </AppBar>
            </Container>
            <Container fluid>
                <Row className="ingreso_general">
                    <Col xs={12} lg={5} className="d-flex justify-content-center flex-column ingreso_derecho">
                        <h1>
                            Descubre el Nuevo
                        </h1>
                        <h1>
                            Portal de CONFIANZA & VIDA
                        </h1>
                        <p>Ahora podrás realizar todas tus operaciones y consultas en un solo lugar.</p>
                    </Col>
                    <Col xs={12} lg={2} className="d-none d-sm-none d-md-none d-lg-flex d-xl-flex justify-content-center flex-column  ingreso_centro hidden-md-down">
                        <Image
                            className="ingreso_ejecutivo"
                            src={`/img/ejecutivo_.svg`}
                            alt="logo_horizontal"
                        />
                    </Col>
                    <Col xs={12} lg={5} className="d-flex justify-content-center flex-column ingreso_izquierdo">
                        <Form onSubmit={enviarDatos} id="formulario">
                            <Col xs={12} className="mb-3">
                                <h3 className="d-inline">Inicia</h3> <h3 className="d-inline">sesión</h3>
                            </Col>
                            <Col xs={12} className="mb-3">
                                <TextField
                                    error={!datos_verificado.dni}
                                    label="DNI"
                                    name="dni"
                                    value={datos.dni}
                                    onChange={handleInputChange}
                                    fullWidth={true}
                                    variant="outlined"
                                    size="small"
                                    autoComplete="off"
                                />
                            </Col>
                            <Col xs={12} className="mb-3">
                                <TextField
                                    error={!datos_verificado.password}
                                    label="Contraseña"
                                    name="password"
                                    value={datos.password}
                                    type="password"
                                    onChange={handleInputChange}
                                    fullWidth={true}
                                    variant="outlined"
                                    size="small"
                                    autoComplete="off"
                                />
                            </Col>
                            <Col xs={12} className="mb-3">
                                <Checkbox
                                    checked={datos.recordar}
                                    onChange={handleInputChange}
                                    name="recordar"
                                    color="primary"
                                /> Mantener la sesión iniciada
                            </Col>
                            <Col xs={12} className="mb-3">
                                <Button variant="contained" type="submit" className="btn-principal">Ingresar</Button>
                            </Col>
                            {JSON.stringify(datos)}
                            {JSON.stringify(datos_verificado)}
                        </Form>
                    </Col>
                </Row>
            </Container>
        </>
    );
}
export default Ingreso;
if (document.getElementById("ingreso")) {
    ReactDOM.render(<Ingreso />, document.getElementById("ingreso"));
}
