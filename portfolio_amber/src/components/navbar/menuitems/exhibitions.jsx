import React, { Component } from 'react';
import ExhibitionListItem from '../../../components/exhibitionlistitem';


class Exhibitions extends Component {

  state = {
    exhibitions: [
      {
        id: 1,
        name: 'lorem ipsum dolor sin lorem ipsum dolor sin',
        date: '08.04.2020'
      },
      {
        id: 2,
        name: 'lorem ipsum dolor sin',
        date: '08.02.2019'
      },
      {
        id: 2,
        name: 'lorem ipsum dolor sin',
        date: '10.12.2021'
      }
    ]
  };


  render() {
    return (
      <div className='w-full z-40 bg-white absolute lg:relative lg:w-auto top-0 left-0 h-full lg:h-auto lg:border lg:border-t-0 lg:border-black p-4'>
        <h1 className='text-5xl mb-4 lg:hidden  uppercase'>Exhibitions</h1>

        <ul className='py-4 lg:pt-0'>
          { this.state.exhibitions.map((value) => {
            return <ExhibitionListItem  exhibit={value}/>
          })}
        </ul>


        <p className='text-2xl uppercase mt-4'>Past exhibitions</p>
        <ul className='py-4'>
          { this.state.exhibitions.map((value) => {
            return <ExhibitionListItem  exhibit={value}/>
          })}
        </ul>

      </div>
    )
  }
}

export default Exhibitions;
