import React, { useEffect, useState } from 'react'
import ReactDOM from 'react-dom'
import { Container, Row, Col, Accordion, Card, Alert, Image, Spinner, Button, Form, InputGroup, Modal } from 'react-bootstrap'
import { estilos, color_principal, confiTypeahead } from '../../estilos'
import { EyeFill, Scissors, PlusCircleFill, DashCircleFill, Justify, Search, EmojiFrown, CheckCircleFill, ExclamationDiamond } from 'react-bootstrap-icons'
import { Typeahead } from 'react-bootstrap-typeahead'
import './cupones.scss'
const Cupones = () => {
    // Aqui van los useState
    const [spinnerCupones, setSpinnerCupones] = useState(true)
    const [cupones, setCupones] = useState([])
    const [activeId, setActiveId] = useState(null)
    const [listEmpresas, setListEmpresas] = useState([])
    const [listClientes, setListClientes] = useState([])
    const [showModalAnular, setShowModalAnular] = useState(false)
    const [id_poliza_seleccionada, setid_poliza_seleccionada] = useState({
        id: '',
        nro_poliza: '',
    })
    const [datos, setDatos] = useState({
        id_cliente: [],
        id_empresa: [],
        nro_poliza: '',
        nro_cuota: ''
    })
    const [actualizar_datos, setActualizar_datos] = useState(true)
    //  Aqui van los useEffect
    useEffect(() => {
        let id_empresa = datos.id_empresa.length <= 0 ? 'null' : `${datos.id_empresa[0].id}`
        let id_cliente = datos.id_cliente.length <= 0 ? 'null' : `${datos.id_cliente[0].id}`
        let nro_poliza = datos.nro_poliza === '' ? 'null' : `${datos.nro_poliza}`
        let nro_cuota = datos.nro_cuota === '' ? 'null' : `${datos.nro_cuota}`
        fetch(`/cupones/mostrar/${id_empresa}/${id_cliente}/${nro_poliza}/${nro_cuota}`)
            .then(response => response.json())
            .then(response => {
                setCupones(response)
                setSpinnerCupones(false)
            }
            )
    }, [datos, actualizar_datos])
    useEffect(() => {
        fetch('/aseguradoras/mostrar')
            .then(response => response.json())
            .then(response => {
                setListEmpresas(response)
            }
            )
        fetch('/clientes/mostrar')
            .then(response => response.json())
            .then(response => {
                setListClientes(response)
            }
            )
    }, [])
    // Aqui van als funciones
    const toggleActive = (id) => {
        activeId === id ? setActiveId(null) : setActiveId(id)
    }
    const CambiarEmpresa = (selectedOptions) => {
        setDatos({
            ...datos,
            id_empresa: selectedOptions,
        })
    }
    const CambiarCliente = (selectedOptions) => {
        setDatos({
            ...datos,
            id_cliente: selectedOptions,
        })
    }
    const CambiarInput = (event) => {
        setDatos({
            ...datos,
            [event.target.name]: event.target.value.toLowerCase()
        })
    }
    const ModalAnularCerrar = () => setShowModalAnular(false)
    const ModalAnularAbrir = (id, nro_poliza) => {
        setid_poliza_seleccionada({
            id: id,
            nro_poliza: nro_poliza,
        })
        setShowModalAnular(true)
    }
    const anularPoliza = () => {
        ModalAnularCerrar()
        fetch(`/cupones/anularpoliza/${id_poliza_seleccionada.id}`)
            .then(response => response.json())
            .then(response => {
                setActualizar_datos(!actualizar_datos)
            })
    }
    return (
        <>
            <Container fluid>
                <Row>
                    <Col xs={12} lg={4} className="my-2" style={{ color: color_principal }}>
                        <Card className="p-5">
                            <h3><Search /> Filtros Generales</h3>
                            <Form.Group controlId="id_empresa">
                                <Form.Label>Empresa Aseguradora</Form.Label>
                                <Typeahead
                                    {...confiTypeahead}
                                    id="id_empresa"
                                    selected={datos.id_empresa}
                                    clearButton
                                    labelKey={option => `${option.nombre.toUpperCase()}`}
                                    onChange={CambiarEmpresa}
                                    options={listEmpresas}
                                    inputProps={{ required: true }}
                                />
                            </Form.Group>
                            <Form.Group controlId="id_cliente">
                                <Form.Label>Cliente</Form.Label>
                                <Typeahead
                                    {...confiTypeahead}
                                    id="id_cliente"
                                    selected={datos.id_cliente}
                                    clearButton
                                    labelKey={option => `${option.nombre.toUpperCase()} ${option.nrodoc.toUpperCase()}`}
                                    onChange={CambiarCliente}
                                    options={listClientes}
                                    inputProps={{ required: true }}
                                />
                            </Form.Group>
                            <Form.Group controlId="nro_poliza">
                                <Form.Label>Nº de póliza</Form.Label>
                                <Form.Control name="nro_poliza" type="text" placeholder="Ingrese Nº póliza" onChange={CambiarInput} value={datos.nro_poliza} />
                            </Form.Group>
                            <Form.Group controlId="nro_cuota">
                                <Form.Label>Nº de cuota</Form.Label>
                                <Form.Control name="nro_cuota" type="text" placeholder="Ingrese Nº cuota" onChange={CambiarInput} value={datos.nro_cuota} />
                            </Form.Group>
                        </Card>
                    </Col>
                    <Col xs={12} lg={8} className="my-2">
                        {spinnerCupones ? (
                            <Card>
                                <Row className="justify-content-center align-items-center py-5" style={{ color: color_principal }}>
                                    <Spinner animation="border" /><span className="mx-2">Cargando Información ...</span>
                                </Row>
                            </Card>
                        ) : (<></>)}
                        {cupones.length <= 0 && !spinnerCupones ? (
                            <Card>
                                <Row className="justify-content-center align-items-center py-5" style={{ color: color_principal }}>
                                    <EmojiFrown /><span className="mx-2">No se encontraron resultados</span>
                                </Row>
                            </Card>
                        ) : (<></>)}
                        {cupones.map((cupon, key_cupon) => (
                            <Accordion key={key_cupon + 1}>
                                <Card className="mb-2">
                                    <Accordion.Toggle as={Card.Header} eventKey={key_cupon + 1} style={estilos.acordion} onClick={() => toggleActive(key_cupon + 1)} >
                                        <h6> {activeId === key_cupon + 1 ? (
                                            <>
                                                <DashCircleFill size={20} />
                                            </>
                                        ) : (
                                                <>
                                                    <PlusCircleFill size={20} />
                                                </>
                                            )} {cupon.id_cliente.nombre.toUpperCase()}<br />Nº Documento : {cupon.id_cliente.nrodoc.toUpperCase()}</h6>
                                        <h6>Total pólizas : {cupon.polizas.length}</h6>
                                    </Accordion.Toggle>
                                    <Accordion.Collapse eventKey={key_cupon + 1}>
                                        <Card.Body>
                                            {cupon.polizas.map((poliza, key_poliza) => (
                                                <Row key={key_poliza}>
                                                    <Col>
                                                        <Alert variant="secondary">
                                                            <div>
                                                                <Image src={`./img/logos_empresas_seguros/${poliza.id_poliza.id_empresa.logo}`} fluid style={{ height: '20px' }} />
                                                                <Button size="sm" onClick={() => { ModalAnularAbrir(poliza.id_poliza.id, poliza.id_poliza.nro_poliza_corregido === '' ? poliza.id_poliza.nro_poliza : poliza.id_poliza.nro_poliza_corregido) }} style={{ position: 'absolute', top: 0, right: 0, backgroundColor: '#383d41', color: '#fff', borderWidth: 0 }}>Anular</Button><br />
                                                                <b>{poliza.id_poliza.id_empresa.nombre.toUpperCase()} - {poliza.id_poliza.id_empresa.ruc.toUpperCase()}</b><br />
                                                                <b><EyeFill size={20} style={{ cursor: 'pointer' }} /> {poliza.id_poliza.id_ramo.descripcion.toUpperCase()}</b> - {poliza.id_poliza.id_producto.nombre.toUpperCase()}<br />
                                                                <b>Nº {poliza.id_poliza.nro_poliza_corregido === '' ? poliza.id_poliza.nro_poliza : poliza.id_poliza.nro_poliza_corregido}</b>
                                                            </div>
                                                            {poliza.id_poliza.vehiculos.length < 0 ? (<></>) :
                                                                poliza.id_poliza.vehiculos.map((vehiculo, key_vehiculo) => (
                                                                    <div key={key_vehiculo}>
                                                                        <span><b>Placa : </b>{vehiculo.placa.toUpperCase()}</span> | <span><b>Marca : </b>{vehiculo.marca.marca.toUpperCase()}</span> | <span><b>Modelo : </b>{vehiculo.modelo.modelo.toUpperCase()}</span>
                                                                    </div>
                                                                ))
                                                            }
                                                            <hr />
                                                        </Alert>
                                                    </Col>
                                                </Row>
                                            ))}
                                        </Card.Body>
                                    </Accordion.Collapse>
                                </Card>
                            </Accordion>
                        ))}
                    </Col>
                </Row>
            </Container>
            <Modal show={showModalAnular} onHide={ModalAnularCerrar}>
                <Modal.Body>
                    ¿Esta seguro que desea anular la poliza <b>Nº {id_poliza_seleccionada.nro_poliza}</b>?
                </Modal.Body>
                <Modal.Footer>
                    <Button variant="secondary" size="sm" onClick={ModalAnularCerrar}>
                        Cancelar
                    </Button>
                    <Button variant="danger" size="sm" onClick={anularPoliza}>
                        Anular
                    </Button>
                </Modal.Footer>
            </Modal>
            {JSON.stringify(cupones)}
        </>
    )
}
export default Cupones
if (document.getElementById("cupones")) {
    const element = document.getElementById('cupones')
    const props = Object.assign({}, element.dataset)
    ReactDOM.render(<Cupones {...props} />, element)

}