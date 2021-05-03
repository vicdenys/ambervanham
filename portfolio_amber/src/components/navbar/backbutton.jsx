import React, { Component } from 'react';

class BackButton extends Component {

  state = {};



  render() {
    return (
      <div className="relative group flex items-center" onClick={this.props.backClicked}>
        <svg xmlns="http://www.w3.org/2000/svg" className="h-5 w-5 -mt-1/2" viewBox="0 0 20 20" fill="currentColor">
          <path fillRule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clipRule="evenodd" />
        </svg>
        <button className="text-left  inline uppercase py-4 focus:outline-none">
          {this.props.buttonName}
        </button>
      </div>
    )
  }
}

export default BackButton;
