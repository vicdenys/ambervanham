import React, { Component } from 'react';

class Link extends Component {

  state = {};


  render() {
    return (
      <div className={'flex items-center ' + ( this.props.isSmal  ? 'justify-between' : '')}>
        <a href="facebook.com" className={' '  + ( !this.props.isSmal  ? 'uppercase text-2xl' : 'w-40')}>{this.props.linkName}</a>
        <div className='w-4 h-4 relative border-r-4 border-t-4 border-black  ml-4'>
          <div className='relative bg-black w-1 h-5 left-1/2 top-1/2 transform -translate-y-1/2 -translate-x-1/2 origin-center rotate-45'></div>
        </div>
      </div>
    )
  }
}

export default Link;
