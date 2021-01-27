import React from 'react'
import ReactDOM from 'react-dom'
import AppBar from '@material-ui/core/AppBar'
import Toolbar from '@material-ui/core/Toolbar'
import Typography from '@material-ui/core/Typography'
import Button from '@material-ui/core/Button'
import IconButton from '@material-ui/core/IconButton'
import MenuIcon from '@material-ui/icons/Menu'
import Menu from '@material-ui/core/Menu'
import Image from 'react-bootstrap/Image'
import './menu_top.scss'
const MenuTop = () => {
    return (
        <AppBar position="static" elevation={0}>
            <Toolbar>
                <IconButton edge="start" color="inherit" aria-label="menu" className="mx-3">
                </IconButton>
                <div id="div_menu_top">
                    <Image
                        className="menu_logo_horizontal"
                        src={`/img/logo_horizontal_white.svg`}
                        alt="logo_horizontal_blanco"
                        fluid
                    />
                </div>
            </Toolbar>
        </AppBar>
    )
}
export default MenuTop
