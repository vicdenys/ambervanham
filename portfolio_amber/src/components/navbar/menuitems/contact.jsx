import React, { Component } from 'react';
import Link from '../../../components/link';

class Contact extends Component {

  state = {

  };


  render() {
    return (
      <div className='w-full z-40 bg-white absolute lg:relative lg:w-auto top-0 left-0 h-full lg:h-auto lg:border lg:border-t-0 lg:border-black p-4'>

        <h1 className='text-5xl border-b border-black lg:hidden  mb-4 uppercase'>Contact</h1>
        <Link  linkName='facebook'/>
        <Link  linkName='instagram'/>
        <Link  linkName='mail'/>
      </div>
    )
  }
}

export default Contact;
