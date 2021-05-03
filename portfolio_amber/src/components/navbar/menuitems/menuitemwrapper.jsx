import React, { Component } from 'react';
import MenuButton from '../../navbar/menubutton';
import BackButton from '../../navbar/backbutton';


class MenuItemWrapper extends Component {

  state = {
    open: false,
  };

  toggle = () => {

    this.setState({
      open : !this.state.open,
    })

    this.props.menuItemOpen(!this.state.open);
  };


  render() {
    return (
      <div className="bg-white " >
        <MenuButton buttonName={this.props.title} onClick={this.toggle} isOpen={this.state.open} />

        <div className={'overflow-hidden z-50 lg:relative lg:border-b lg:border-black transition-all duration-500 ease-in-out  ' + ( !this.state.open  ? 'lg:max-h-0 lg:block ' : 'lg:max-h-screen  lg:block ')}>
          <div className={'lg:hidden z-50 top-0 absolute ' + ( !this.state.open  ? 'hidden' : '')}>
            <BackButton backClicked={this.toggle}  buttonName='back'/>
          </div>

          <div className={'mt-12 lg:mt-0 bg-white absolute lg:relative top-0 lg:top-auto left-0 lg:left-auto h-full lg:h-auto lg:w-auto transition-all  w-full  duration-500 ease-in-out '  + ( !this.state.open  ? 'hidden' : ' ')}>
              {this.props.elem}
          </div>

        </div>
      </div>
    )
  }
}

export default MenuItemWrapper;
