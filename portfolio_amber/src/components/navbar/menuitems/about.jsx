import React, { Component } from 'react';

class About extends Component {

  state = {

  };


  render() {
    return (
      <div className='w-full z-40 bg-white absolute lg:relative lg:w-auto top-0 left-0 h-full lg:h-auto lg:border lg:border-t-0 lg:border-black p-4'>
        <h1 className='text-5xl border-b border-black lg:hidden  uppercase'>About me</h1>
        <p className='mt-4 lg:mt-0 lg:mb-2'><span className='pl-4 text-xl '>Als observator gaat de Antwerpse kunstenares Amber van Ham te werk. Ze zoekt taferelen van haar leven op en scherpt deze herinneringen aan in haar werken.</span>
        <br />
        <br />
        Als een close up, om de momenten te vereeuwigen die haar leven collecteren. Zo vertrekt ze vaak van uit foto's die om een of andere reden mislukt zijn, maar wel een emotionele waarde hebben. De beweging die zich hier in situeert, werkt misschien niet als foto, maar het hiervan voltrekken tot kunstwerk kan zeer interessante beelden opleveren.</p>
      </div>
    )
  }
}

export default About;
