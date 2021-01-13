import React, { useState } from 'react'
import ReactDOM from 'react-dom'
import { Form, Container, Row, Col, Image } from 'react-bootstrap'
import TextField from '@material-ui/core/TextField'
import Button from '@material-ui/core/Button'
import AppBar from '@material-ui/core/AppBar';
import Toolbar from '@material-ui/core/Toolbar';
import './ingreso.scss'
const Ingreso = () => {
    const [datos, setDatos] = useState({
        dni: '',
        password: '',
    })
    const [variante, setVariante] = useState({
        style: '',
        mensaje: '',
    });
    const handleInputChange = (event) => {
        setDatos({
            ...datos,
            [event.target.name]: event.target.value
        })
    }

    const enviarDatos = (event) => {
        event.preventDefault();
        var url = `${URL}Auth/Ingresar`;
        fetch(url, {
            method: 'POST',
            body: JSON.stringify(datos),
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(res => res.json())
            .catch(error => console.error('Error:', error))
            .then(response => {
                if (response === 0) {
                    window.location.href = `${URL}Dashboard/Inicio`
                }
                if (response === 1) {
                    setVariante({
                        style: 'error',
                        mensaje: 'DNI de usuario o contraseña incorrecta',
                    })
                }
                if (response === 2) {
                    setVariante({
                        style: 'warning',
                        mensaje: 'Falta rellenar campos',
                    })
                }
            });
    }
    return (
        <>
            <Container>
                <AppBar position="fixed" color="transparent" elevation="elevation0">
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
                                    label="Usuario"
                                    name="dni"
                                    value={datos.dni}
                                    onChange={handleInputChange}
                                    required
                                    fullWidth={true}
                                    variant="outlined"
                                    size="small"
                                />
                            </Col>
                            <Col xs={12} className="mb-3">
                                <TextField
                                    label="Contraseña"
                                    name="password"
                                    value={datos.password}
                                    type="password"
                                    onChange={handleInputChange}
                                    required
                                    fullWidth={true}
                                    variant="outlined"
                                    size="small"
                                />
                            </Col>
                            <Col xs={12} className="mb-3">
                                <Button variant="contained" type="submit" className="btn-principal">Ingresar</Button>
                            </Col>
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
