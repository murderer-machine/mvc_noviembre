import React, { useEffect, useState } from 'react'
import ReactDOM from 'react-dom'
import { Container, Row, Col, Accordion, Card, Alert, Image, Spinner, Button, Form, InputGroup,Modal } from 'react-bootstrap'
import { estilos, color_principal, confiTypeahead } from '../../estilos'
import { EyeFill, Scissors, PlusCircleFill, DashCircleFill, Justify, Search, EmojiFrown, CheckCircleFill, ExclamationDiamond } from 'react-bootstrap-icons'
import { Typeahead } from 'react-bootstrap-typeahead'
import './cupones.scss'
const Cupones = () => {
    const [listEmpresas, setListEmpresas] = useState([])
    const [listClientes, setListClientes] = useState([])
    const [id_poliza_seleccionada, setId_poliza_seleccionada] = useState(0)
    const [cupones, setCupones] = useState([])
    const [spinnerCupones, setSpinnerCupones] = useState(true)
    const [condicionAnular, setCondicionAnular] = useState(true)
    const [condicionCupones, setCondicionCupones] = useState(0)
    const [datos, setDatos] = useState({
        id_cliente: [],
        id_empresa: [],
        nro_poliza: '',
        nro_cuota: '',
    })
    const [activeId, setActiveId] = useState(null);
    const toggleActive = (id) => {
        if (activeId === id) {
            setActiveId(null);
        } else {
            setActiveId(id);
        }
    }
    const CambiarInput = (event) => {
        setDatos({
            ...datos,
            [event.target.name]: event.target.value.toLowerCase()
        })
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
    useEffect(() => {
        setCondicionCupones(condicionCupones + 1);
        condicionCupones < 1 ? setSpinnerCupones(true) : {}
        let id_empresa = datos.id_empresa.length <= 0 ? 'null' : `${datos.id_empresa[0].id}`
        let id_cliente = datos.id_cliente.length <= 0 ? 'null' : `${datos.id_cliente[0].id}`
        let nro_poliza = datos.nro_poliza === '' ? 'null' : `${datos.nro_poliza}`
        let nro_cuota = datos.nro_cuota === '' ? 'null' : `${datos.nro_cuota}`
        fetch(`/cupones/mostrar/${id_empresa}/${id_cliente}/${nro_poliza}/${nro_cuota}`)
            .then(response => response.json())
            .then(response => {
                setCupones(response)
                condicionCupones < 1 ? setSpinnerCupones(false) : setId_poliza_seleccionada(0)
            }
            )
    }, [datos, condicionAnular])
    const anularPoliza = (id) => {
        setId_poliza_seleccionada(id)
        fetch(`/cupones/anularpoliza/${id}`)
            .then(response => response.json())
            .then(response => {
                setCondicionAnular(!condicionAnular)
                inputRef.current[id].style.display = 'none'
            }
            )
    }
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

    const [showModalAnular, setShowModalAnular] = useState(false)
    const ModalAnularCerrar = () => setShowModalAnular(false)
    const ModalAnularAbrir = () => setShowModalAnular(true)
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
                    {spinnerCupones ? (
                        <Col xs={12} lg={8} className="my-2 text-center">
                            <Card>
                                <Row className="justify-content-center align-items-center py-5" style={{ color: color_principal }}>
                                    <Spinner animation="border" /><span className="mx-2">Cargando Información ...</span>
                                </Row>
                            </Card>
                        </Col>
                    ) : (
                            <>
                                {cupones.length <= 0 ? (
                                    <Col xs={12} lg={8} className="my-2 text-center">
                                        <Card>
                                            <Row className="justify-content-center align-items-center py-5" style={{ color: color_principal }}>
                                                <EmojiFrown /><span className="mx-2">No se encontraron resultados</span>
                                            </Row>
                                        </Card>
                                    </Col>
                                ) : (<></>)}
                                <Col xs={12} lg={8} className="my-2">
                                    <Accordion>
                                        {cupones.map((cupon, id) => (
                                            <Card key={id + 1} className="mb-2">
                                                <Accordion.Toggle as={Card.Header} eventKey={id + 1} style={estilos.acordion} onClick={() => toggleActive(id + 1)} >
                                                    <h6> {activeId === id + 1 ? (
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
                                                <Accordion.Collapse eventKey={id + 1}>
                                                    <Card.Body>
                                                        {cupon.polizas.map((poliza, i) => (
                                                            <Row key={i}>
                                                                <Col>
                                                                    <Alert variant="secondary">
                                                                        <div>
                                                                            <Image src={`./img/logos_empresas_seguros/${poliza.id_poliza.id_empresa.logo}`} fluid style={{ height: '20px' }} />
                                                                            <Button size="sm" onClick={() => { anularPoliza(poliza.id_poliza.id) }} style={{ position: 'absolute', top: 0, right: 0, backgroundColor: '#383d41', color: '#fff', borderWidth: 0 }}>Anular</Button><br />
                                                                            <b>{poliza.id_poliza.id_empresa.nombre.toUpperCase()} - {poliza.id_poliza.id_empresa.ruc.toUpperCase()}</b><br />
                                                                            <b><EyeFill size={20} style={{ cursor: 'pointer' }} /> {poliza.id_poliza.id_ramo.descripcion.toUpperCase()}</b> - {poliza.id_poliza.id_producto.nombre.toUpperCase()}<br />
                                                                            <b>Nº {poliza.id_poliza.nro_poliza_corregido === '' ? poliza.id_poliza.nro_poliza : poliza.id_poliza.nro_poliza_corregido}</b>
                                                                        </div>
                                                                        {poliza.id_poliza.vehiculos.length < 0 ? (<></>) :
                                                                            poliza.id_poliza.vehiculos.map((vehiculo, i) => (
                                                                                <div key={i}>
                                                                                    <span><b>Placa : </b>{vehiculo.placa.toUpperCase()}</span> | <span><b>Marca : </b>{vehiculo.marca.marca.toUpperCase()}</span> | <span><b>Modelo : </b>{vehiculo.modelo.modelo.toUpperCase()}</span><br />
                                                                                </div>
                                                                            ))
                                                                        }
                                                                        <hr />
                                                                        {poliza.documentos.map((documento, i) => (
                                                                            <Row key={i}>
                                                                                <Col>
                                                                                    <Row>
                                                                                        <Col xs={12} lg={8}>
                                                                                            <Row>
                                                                                                {documento.cupones.map((cupon, i) => (
                                                                                                    <Col key={i} xs={12} md={6} lg={6} xl={4}>
                                                                                                        <div className="cupon_vencido text-center">
                                                                                                            <Scissors size={20} style={{
                                                                                                                position: 'absolute',
                                                                                                                top: -10,
                                                                                                                left: 5,
                                                                                                                transform: 'rotate(90deg)'
                                                                                                            }} />
                                                                                                    Cupón Nº <b>{cupon.nro_orden} - {cupon.fecha_obligacion}</b><br />
                                                                                                            <b>CP {cupon.nro_cuota}</b><br />
                                                                                                            <b>{poliza.id_poliza.moneda.simbolo} {cupon.importe}</b><br />
                                                                                                            <h6><b><small>Pago vencido </small>{cupon.dias_vencidos}<small> {cupon.dias_vencidos > 1 ? 'días' : 'día'}</small></b></h6>
                                                                                                            <CheckCircleFill
                                                                                                                color="#F44336"
                                                                                                                size={30}
                                                                                                                style={{
                                                                                                                    position: 'absolute',
                                                                                                                    top: '40.5px',
                                                                                                                    right: '0',
                                                                                                                    cursor: 'pointer'
                                                                                                                }}
                                                                                                                onClick={() => { alert(poliza.id_poliza.id) }}
                                                                                                            />
                                                                                                        </div>
                                                                                                    </Col>
                                                                                                ))}
                                                                                            </Row>
                                                                                        </Col>
                                                                                        <Col xs={12} lg={4}>
                                                                                            Hache (Mario Casas) regresa desde Londres a Barcelona, donde ha pasado dos años. Hache no ha podido dejar atrás su pasado: ni a Pollo, ni a su familia, ni a Babi. Una de las primeras personas con las que se reencuentra es con Katina (Marina Salas), la antigua novia de Pollo. Por lo visto, ella tampoco ha podido superar su muerte.
                                                                                        </Col>
                                                                                    </Row>
                                                                                </Col>
                                                                            </Row>
                                                                        ))}
                                                                        <div className="anular_poliza" style={{ display: id_poliza_seleccionada == poliza.id_poliza.id ? 'flex' : 'none' }}><Spinner animation="border" /><span className="mx-2">Anulando ...</span></div>
                                                                    </Alert>
                                                                </Col>
                                                            </Row>
                                                        ))}
                                                    </Card.Body>
                                                </Accordion.Collapse>
                                            </Card>
                                        ))}
                                    </Accordion>
                                </Col>
                            </>
                        )}
                </Row>
            </Container>
            <Modal show={showModalAnular} onHide={ModalAnularCerrar}>
                <Modal.Header closeButton>
                    <Modal.Title>Modal heading</Modal.Title>
                </Modal.Header>
                <Modal.Body>Woohoo, you're reading this text in a modal!</Modal.Body>
                <Modal.Footer>
                    <Button variant="secondary" onClick={ModalAnularCerrar}>
                        Close
          </Button>
                    <Button variant="primary" onClick={ModalAnularCerrars}>
                        Save Changes
          </Button>
                </Modal.Footer>
            </Modal>
        </>
    )
}
export default Cupones
if (document.getElementById("cupones")) {
    const element = document.getElementById('cupones')
    const props = Object.assign({}, element.dataset)
    ReactDOM.render(<Cupones {...props} />, element)

}