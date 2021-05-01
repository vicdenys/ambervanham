import React, { Component } from 'react';
import MenuButton from './menubutton';

class NavBar extends Component {

  state = {
    menuOpened: false,
    menuAnimationRunning: false
  }

  toggleMenu = () => {
    if (!this.state.menuAnimationRunning){
      this.setState({
        menuOpened : !this.state.menuOpened,
        menuAnimationRunning: true
      })

      // Start timer for animation
      setTimeout(() => {
        this.setState({
          menuAnimationRunning: false
        })
      }, 1500);
    }

  }

  render() {
    return (
      <nav className="">


        {/* wrapper logo and menu */}
        <div className="mx-auto px-4 py-4 flex justify-between items-center border-solid border-b border-black">
          {/* Logotype */}
          <div className=" ">
            <div className="flex items-center ">
              <div className="rounded-full h-2 w-2 bg-red-600 float-left mr-2" ></div>
              <h1 className="text-2xl sm:text-4xl uppercase text-stroke-1 text-fill-white float-left">Amber van Ham</h1>
            </div>
            <p className='block ml-4 text-xs'>Portfolio Webiste</p>
          </div>

          {/* Hamburger menu */}
          <div className="lg:hidden w-10 h-7 relative cursor-pointer transition duration-500 ease-in-out z-50" onClick={this.toggleMenu}>
            <span className={"block absolute h-1 w-10 bg-black transition duration-250 ease-in-out  " + (this.state.menuOpened ? 'transform rotate-135 top-3' : 'top-0')}></span>
            <span className={"block absolute h-1 w-10 bg-black transition-all duration-250 ease-in-out top-3 " + (this.state.menuOpened? '-left-10 opacity-0' : 'left-0')}></span>
            <span className={"block right-0 absolute h-1 bg-black transition duration-250 ease-in-out " + (this.state.menuOpened ? 'transform -rotate-135 top-3  w-10' : 'top-6  w-8')}></span>
          </div>
        </div>



        {/* Menu open animation */}
        <div className={"bg-gray-200 absolute w-0 h-full top-0 z-40 " + ( this.state.menuAnimationRunning  ? 'animate-openmenufast' : '')}></div>
        <div className={"bg-black absolute w-0  h-full left-0 top-0 z-30 " + ( this.state.menuAnimationRunning ? 'animate-openmenuslow' : '')}></div>

        {/* Menu items */}
        <div className={'grid grid-cols-1 lg:grid-cols-3 gap-6 mx-auto top-0 bg-white px-4 w-full absolute h-full pt-40 transition duration-250 ease-in-out opacity-0 delay-300 lg:opacity-100 lg:h-auto lg:bg-transparent lg:top-auto lg:pt-4 ' + (this.state.menuOpened ? 'opacity-100' : '')}>
          <MenuButton buttonName='01. About'/>
          <MenuButton buttonName='02. Exhibitions'/>
          <MenuButton buttonName='03. Contact'/>
        </div>

      </nav>
    )
  }
}

export default NavBar;
