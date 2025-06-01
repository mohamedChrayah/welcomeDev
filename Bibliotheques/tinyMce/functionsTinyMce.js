/**
 * 
 * @param {Id du textArea} idTextArea 
 * @param {Pour ajouter des fonctionnalitées a la toobar https://www.tiny.cloud/docs/tinymce/6/available-toolbar-buttons/} toolbar 
 * @param {nombre de characteres max entré par l 'utilisateur'} limitChar 
 * @param {pour ajouter du css à la biblitheque https://www.tiny.cloud/docs/tinymce/6/add-css-options/} css 
 */


/**
 * Si vous devez mettre des liens dans une modal bootstrap vous devez mettre ce code pour fix le bug bootstrap
 *  $.fn.modal.Constructor.prototype._enforceFocus = function _enforceFocus() {
        $(ID_DE_LA_MODAL).off(Event.FOCUSIN).on(Event.FOCUSIN, function (event) {
        if (
            document !== event.target
            && this._element !== event.target
            && $(this._element).has(event.target).length === 0
            && !$(event.target.parentNode).hasClass('tox-tinymce-aux')
            && !$(event.target.parentNode).hasClass('moxman-window')
            && !$(event.target.parentNode).hasClass('tam-assetmanager-root')
            && !$(event.target.parentNode).hasClass('tox-textfield')
        ) {
            this._element.focus();
        }
        });
    };
 */ 




function activateTinyMCE(idTextArea, toolbar = '',autoSave = '', limitChar = 5000, css = '', readonly = false, dragDropAction = false, projetRef = '') {
    let toolbarDefault = 'undo redo | styles | bold italic underline link alignleft aligncenter alignright | ';
    toolbarDefault = toolbarDefault + toolbar;
    tinymce.init({
        selector: 'textarea#' + idTextArea,
        plugins: 'link lists wordcount visualchars preview ',
        link_default_target: '_blank',
        menubar: false,
        language: 'fr_FR',
        toolbar1: toolbarDefault,
        toolbar: 'wordcount',
        content_style: css,
        readonly: readonly,
        convert_urls:false,
        setup: function(editor) {
            let numberInput = 0;
            editor.on('keyup', function(event) {
                var max = limitChar;
                var numChars = tinymce.activeEditor.plugins.wordcount.body.getCharacterCount();
                if (numChars >= max) {
                    swal("Information", 'Nombre de caractères maximum atteint', 'info')
                    event.preventDefault();
                    return false;
                }
            });
            // A refaire si besoin d'autosave
            if (autoSave == 'creditTarif') {
                editor.on('keyup', function(event) {
                    let date = new Date();
                    let month = day = '';
                    if (date.getMonth() < 10) {
                        month = '0'+(date.getMonth()+1);
                    } else {
                        month = (date.getMonth()+1);
                    }
                    if (date.getDate() < 10) {
                        day = '0'+date.getDate();
                    } else {
                        day = date.getDate();
                    }
                    
                    // Récupération des données de la page + construction du data pour l'envoi
                    let inputs = $('#formTarif').find("input[name^='modificationHeadCol']");
                    let data = {};
                    for (let i = 0; i < 6; i++) {
                        data['modificationDataCol'+i] = tinymce.get("modificationDataCol"+i).getContent();                        
                    }
                    
                    for (let inputI = 0; inputI < inputs.length; inputI++) {
                        data[inputs[inputI].name] = inputs[inputI].value
                    }
    
                    data['id_groupe'] = $_GET('id_groupe');
                    data['id_reseau'] = $_GET('id_reseau');
                    data['date_maj'] = date.getFullYear()+'-'+month+'-'+day

                    // sauvegarde au bout de 5 touches
                    if (numberInput == 5) {
                        $.ajax({
                            type: "POST",
                            url: "DBAC/291_Delegations_Vertueuses/Ajax/ajax.php",
                            dataType: "json",
                            data: {
                                parametre : "autoSaveTarif",
                                data: data
                            },
                            success: function (data) {
                                numberInput = 0;
                            },
                            error: function (data) {
                              swal("Oops", "Erreur", "error");
                              console.log("Erreur ajax, data ==> ");
                              console.log(data);
                            },
                        });
                    }else{
                        numberInput++
                    }
                });
            }
              // A refaire si besoin permet d'appler une fonction au relachement d'une touche
            if (autoSave == 'commercialisation') {
                editor.on('focus', function () {
                    saveChangeCommercialisation(editor);
                })
                editor.on('blur', function () {
                    saveChangeCommercialisation(editor);
                })
                editor.on('keyup', function() {
                    saveChangeCommercialisation(editor);
                })
            }
            if (autoSave == 'commentaire_complementaire') {
                editor.on('focus', function () {
                    saveChangeCommentaireComplementaire(editor);
                })
                editor.on('blur', function () {
                    saveChangeCommentaireComplementaire(editor);
                })
                editor.on('keyup', function() {
                    saveChangeCommentaireComplementaire(editor);
                })
            }

            // Projet 218-374 immoDT et bailleurs socieux coll pub
            if (autoSave == 'saveRecoBailleursmacl') {
                editor.on('focus', function () {
                    saveChangeRecosmacl(editor);
                })
                editor.on('blur', function () {
                    saveChangeRecosmacl(editor);
                })
                editor.on('keyup', function() {
                    saveChangeRecosmacl(editor);
                })
            }
            if (autoSave == 'saveRecoBailleurabf') {
                editor.on('focus', function () {
                    saveChangeRecoabf(editor);
                })
                editor.on('blur', function () {
                    saveChangeRecoabf(editor);
                })
                editor.on('keyup', function() {
                    saveChangeRecoabf(editor);
                })
            }
            if (autoSave == 'saveRecoBailleurenr') {
                editor.on('focus', function () {
                    saveChangeRecoenr(editor);
                })
                editor.on('blur', function () {
                    saveChangeRecoenr(editor);
                })
                editor.on('keyup', function() {
                    saveChangeRecoenr(editor);
                })
            }
 
 
            // Permet de faire fonctionner le tinyMCE du projet 301 (DFR)
            // RUBRIQUE PROJET
            if (autoSave == 'outilWordProjet') {
                editor.on('focus', function () {
                    sauvegarderChangementProjet('outilWordProjet','textarea');
                })
                editor.on('blur', function () {
                    sauvegarderChangementProjet('outilWordProjet','textarea');
                })
                editor.on('keyup', function() {
                    sauvegarderChangementProjet('outilWordProjet','textarea');
                })
            }
            // RUBRIQUE FINANCEMENT
            if (autoSave == 'outilWordFin') {
                editor.on('focus', function () {
                    sauvegarderChangementFinancementCommentaire('outilWordFin','textarea');
                })
                editor.on('blur', function () {
                    sauvegarderChangementFinancementCommentaire('outilWordFin','textarea');
                })
                editor.on('keyup', function() {
                    sauvegarderChangementFinancementCommentaire('outilWordFin','textarea');
                })
            }   
            // Permet d'initialiser les tinyMCE du projet 301 (DFR) dans la rubrique EXPERTISE
            const tab301 = [
                'outilWordExpertComplement',
                'outilWordExpertPointFort',
                'outilWordExpertPointFaible',
                'outilWordExpertRemarque',
                'outilWordExpertAvis'
            ]
            for (let index = 0; index < tab301.length; index++) {
                const element = tab301[index];
                if (autoSave == element) {
                    editor.on('focus', function () {
                        sauvegarderChangementCommentaireExpert(element, 'textarea');
                    })
                    editor.on('blur', function () {
                        sauvegarderChangementCommentaireExpert(element, 'textarea');
                    })
                    editor.on('keyup', function () {
                        sauvegarderChangementCommentaireExpert(element, 'textarea');
                    })
                }
            } 
            // RUBRIQUE AVIS
            if (autoSave == 'outilWordRCPR') {
                editor.on('focus', function () {
                    sauvegarderChangementAvis('outilWordRCPR', 'textarea');
                })
                editor.on('blur', function () {
                    sauvegarderChangementAvis('outilWordRCPR', 'textarea');
                })
                editor.on('keyup', function () {
                    sauvegarderChangementAvis('outilWordRCPR', 'textarea');
                })
            }
            if (autoSave == 'outilWordCIV') {
                editor.on('focus', function () {
                    sauvegarderChangementAvis('outilWordCIV', 'textarea');
                })
                editor.on('blur', function () {
                    sauvegarderChangementAvis('outilWordCIV', 'textarea');
                })
                editor.on('keyup', function () {
                    sauvegarderChangementAvis('outilWordCIV', 'textarea');
                })
            }   
            // RUBRIQUE DECISION
            if (autoSave == 'outilWordDecisionReserve') {
                editor.on('focus', function () {
                    sauvegarderChangementDecision('outilWordDecisionReserve', 'textarea');
                })
                editor.on('blur', function () {
                    sauvegarderChangementDecision('outilWordDecisionReserve', 'textarea');
                })
                editor.on('keyup', function () {
                    sauvegarderChangementDecision('outilWordDecisionReserve', 'textarea');
                })
            }

            /**
             * 381 Projet : AGILOR
             */
            // RUBRIQUE DECISION
            if (autoSave == '381_Outil_Agilor_AvisExpert') {
                editor.on('focus', function () {
                    enregistrerAvis(editor);
                })
                editor.on('blur', function () {
                    enregistrerAvis(editor);
                })
                editor.on('keyup', function () {
                    enregistrerAvis(editor);
                })
            }               
            
            // GESTION DRAG AND DROP SI dragDropAction = true
            if (dragDropAction) {
                editor.on('drop', (e) => {
                    if(e.dataTransfer) {
                        // ON VERIFIE SI projetRef EGAL A UN PROJET PRIS EN CHARGE
                        // SI OUI ON EXECUTE UNE SERIE ACTION 
                        if (projetRef === 'XXX_Masse_Mailing') {
                            // code d'origine
                            /*var data = ev.dataTransfer.getData("text");
                            var dropText =  document.getElementById(data).innerHTML ;
                            var formattedText1 = dropText.replace('&lt;','<');
                            var formattedText2 = formattedText1.replace('&gt;','>');
                            var droparea = document.getElementById('corps');
                            var range1 = droparea.selectionStart;
                            var range2 = droparea.selectionEnd;
                            var val = droparea.value;
                            var str1 = val.substring(0, range1);
                            var str3 = val.substring(range1, val.length);
                            droparea.value = str1 + formattedText2 + str3;
                            */
                            var data = e.dataTransfer.getData("text");
                            var dropText =  document.getElementById(data).innerHTML;
                            editor.insertContent(dropText);
                            e.preventDefault();
                        }
                    }
                });
            }
        }
    })
}
