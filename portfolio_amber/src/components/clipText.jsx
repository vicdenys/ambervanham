import React, { Component } from 'react';
import ReactDOM from 'react-dom';

class ClipText extends Component {

  constructor(props) {
    super(props)
    this.handlelMouseMove= this.handlelMouseMove.bind(this);
  }

  state = {
    firstMove: 0,
    pathPos: {
      x: 0,
      y: 0
    },
    componentPos: {
      x: 0,
      y: 0
    },
    settings: {
      inverted: false,
      clipPathWidth: 100
    }
  };

  componentDidMount() {
    //set component path
    const compPos = ReactDOM.findDOMNode(this.refs['UniqueElementIdentifier']).getBoundingClientRect()

    this.setState((state,props) => ({
      componentPos: {
        x: compPos.x,
        y: compPos.y
      },
      settings: (typeof props.settings !== 'undefined')? {
        inverted: (typeof props.settings.inverted !== 'undefined')? true : false,
        clipPathWidth: (typeof props.settings.clipPathWidth !== 'undefined')? props.settings.clipPathWidth : 100,
      } : state.settings,

    }));
    window.addEventListener('mousemove', this.handlelMouseMove);
  }
  componentWillUnmount() {
    window.removeEventListener('mousemove', this.handlelMouseMove);
  }


  handlelMouseMove = (e) => {

    if (!this.state.firstMove){
      this.setState({
        firstMove: 1
      });
    }

    this.setState({
      pathPos: {
        x: e.clientX - this.state.componentPos.x,
        y: e.clientY - this.state.componentPos.y,
      }
    });
  };



  render() {

    return (
      <div ref='UniqueElementIdentifier' className={"flex inline relative "  + (this.state.settings.inverted ? 'text-stroke-1 text-fill-white ':'')} >
        <h1 className={"  " + this.props.style } >{this.props.title}</h1>
        <div className={"flex flex-row absolute w-full h-full " + (this.state.settings.inverted ? 'text-fill-black':'text-stroke-1 text-fill-white ') } style={{clipPath : 'circle('+ this.state.settings.clipPathWidth +'px at '+ this.state.pathPos.x +'px '+ this.state.pathPos.y + 'px) ', opacity : this.state.firstMove}}>
          <h1 className={"  " + this.props.style} >{this.props.title}</h1>
        </div>
      </div>
    )
  }
}

export default ClipText;
