import React, { Component } from 'react';

class MenuButton extends Component {

  state = {};


  render() {
    return (
      <div className="relative group">
        <button className="lg:border-solid lg:hover:bg-gray-100 transition-all duration-250 lg:border lg:border-black lg:pl-4 lg:text-left w-full  uppercase py-4">
          {this.props.buttonName}
        </button>
        <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6 group-hover:animate-hovermenuitem lg:block hidden absolute cursor-pointer right-4 top-1/2 transform -translate-y-2/4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path className="top-3" strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 9l-7 7-7-7" />
        </svg>
      </div>
    )
  }
}

export default MenuButton;
