import React, { Component } from 'react';
import Link from '../components/link';

class ExhibitionListItem extends Component {

  state = {};


  render() {
    return (
      <li key={this.props.exhibit.id} className='border-b py-2 border-black'>
        <p className='text-xs '>{this.props.exhibit.date}</p>
        <Link  linkName={this.props.exhibit.name} isSmal={true}/>
      </li>
    )
  }
}

export default ExhibitionListItem;
