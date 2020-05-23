class TutorialStep{
    addNewStep(button){
        let step = $(button).parents('.form-list-tutorial-item');
        step.after(this.template());
        this.updateStepsOrder();
    }

    updateStepsOrder(){
        $(".form-list-tutorial-item").each(function(index){
            let numberStep = index + 1;
            $(this).find('.step-number').text(numberStep + "º");
            $(this).find('input[name="tutorial_item_passo[]"]').val(numberStep);
        });
    }

    moveUpStep(button){
        let step = $(button).parents('.form-list-tutorial-item');
        step.prev().before(step);
        this.updateStepsOrder();
    }

    moveDownStep(button){
        let step = $(button).parents('.form-list-tutorial-item');
        step.next().after(step);
        this.updateStepsOrder();
    }

    template(){
        return `
        <div class="form-list-tutorial-item">
            <input type="hidden" name="tutorial_item[]" value=""/>
            <input type="hidden" name="tutorial_item_passo[]" value=""/>
            <input type="hidden" name="tutorial_item_status[]" value="adicionar"/>
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="image">
                        <i class="far fa-image"></i>
                        <p>${labelSteps.addImage}</p>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="row">
                        <div class="col-4">
                            <p class="step"><span class="step-number">1º</span><span class="step-text">${labelSteps.step}</span></p>
                        </div>
                        <div class="col-8 text-right">
                            <div class="btn-group btn-group-toggle p-2" data-toggle="buttons">
                                <button type="button" class="btn btn-outline-secondary text-primary" onclick="tutorialStep.moveUpStep(this)">
                                    <i class="fas fa-angle-up"></i>
                                </button>
                                <label class="btn btn-outline-secondary">
                                    ${labelSteps.move}
                                </label>
                                <button type="button" class="btn btn-outline-secondary text-primary" onclick="tutorialStep.moveDownStep(this)">
                                    <i class="fas fa-angle-down"></i>
                                </button>
                            </div>
                            <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="item form-group">
                                <label for="description" class="control-label">${labelSteps.description}</label>
                                <textarea class="form-control" id="description" rows="5" name="tutorial_item_description" cols="50" required></textarea>
                                <div class="invalid-feedback">${labelSteps.fillInput}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-5">
                    <hr/>
                </div>
                <div class="col-2 text-center">
                    <button type="button" class="btn btn-alternate btn-sm" onclick="tutorialStep.addNewStep(this)"><i class="fas fa-plus"></i></button>
                </div>
                <div class="col-5">
                    <hr/>
                </div>
            </div>
        </div>`;
    }
}

var tutorialStep = new TutorialStep();