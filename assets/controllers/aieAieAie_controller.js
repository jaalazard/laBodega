import { Controller } from '@hotwired/stimulus';

/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
export default class extends Controller {
    static targets = ["a"];
    aieAieAie() {
        const aieAieAie = new Audio('sounds/aieAieAie.mp3')
        this.add
        aieAieAie.play();
        }
      }
