import React, { Component } from 'react';
import ClipText from '../clipText';

class Work extends Component {

  state = {
    categories: [
      {
        id: 0,
        name: 'Drawings'
      },
      {
        id: 1,
        name: 'Thai'
      },
      {
        id: 2,
        name: 'Pictures'
      },
      {
        id: 3,
        name: 'Hamvragen'
      },
    ],
    artworks: [
      {
        id: 0,
        categorie_id: 1,
        name: 'lorem ipsum',
        year: 2018
      },
      {
        id: 1,
        categorie_id: 1,
        name: 'lorem ipsum',
        year: 2018
      },
      {
        id: 2,
        categorie_id: 1,
        name: 'lorem ipsum',
        year: 2018
      },
      {
        id: 3,
        categorie_id: 1,
        name: 'lorem ipsum',
        year: 2018
      },
      {
        id: 4,
        categorie_id: 1,
        name: 'lorem ipsum',
        year: 2018
      },
      {
        id: 5,
        categorie_id: 3,
        name: 'lorem ipsum',
        year: 2018
      },
      {
        id: 6,
        categorie_id: 0,
        name: 'lorem ipsum',
        year: 2018
      },
      {
        id: 7,
        categorie_id: 0,
        name: 'lorem ipsum',
        year: 2018
      },
      {
        id: 8,
        categorie_id: 2,
        name: 'lorem ipsum',
        year: 2018
      },
      {
        id: 9,
        categorie_id: 2,
        name: 'lorem ipsum',
        year: 2018
      },
    ]
  };


  render() {
    return (
      <div className='lg:top-52 top-24 relative'>
        <div className='ml-4  mb-4'>
          <ClipText title='Work' style='lg:text-8xl text-6xl uppercase' />
        </div>


        <ul className='ml-4'>
          { this.state.categories.map((value) => {
            return <li key={value.id} className='inline'>
                <button className='py-2 mr-2 focus:outline-none transition-all duration-250 ease-in-out hover:bg-gray-200 px-4 border-solid uppercase text-xs border-black border rounded-full'>{value.name}</button>
              </li>
          })}
        </ul>
        <ul className='mt-12 flex flex-wrap -ml-1'>
          { this.state.artworks.map((value) => {
            return <li key={value.id} className='flex-grow h-96'>

              <img src={'/images/' + value.id + '.jpg'} alt={value.name} className='box-border max-h-full min-w-full object-cover align-bottom -left-1 p-12 border-solid border-black border-l border-t' />
            </li>
          })}
        </ul>


      </div>
    )
  }
}

export default Work;
