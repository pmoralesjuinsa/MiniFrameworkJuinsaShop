<?php


namespace Juinsa\controllers\Admin\Order;


class OrderAjaxAdminController extends OrderAdminController
{

    /**
     * @Inject
     * @var OrderLineService
     */
    protected OrderLineService $orderLineService;

    public function index()
    {

    }

    /**
     * @return void
     */
    public function getOrderLines(): void
    {
        $orderLinesContainer = $orderLines = $orderLines = [];

        if (!isset($_POST['productType'])) {
            $this->sessionManager->getFlashBag()->add('danger', 'No se ha elegido ningún tipo de producto');
        } else {
            $idProductType = (int)$_POST['productType'];

            if (empty($idProductType) || $idProductType <= 0) {
                $this->sessionManager->getFlashBag()->add('danger', 'No se ha elegido un tipo de producto válido');
            } else {
                $orderLines = $this->orderLineService->getAttributesByProductTypeId($idProductType);

                if(!$orderLines) {
                    $this->sessionManager->getFlashBag()->add('warning', 'Éste tipo de producto no tiene atributos asociados');
                }
            }
        }

        $this->setProductAttributesIfWeAreEditing($orderLines);

        $this->renderMessagesToAjax($orderLinesContainer);

        $this->renderAttributesForAjax($orderLines, $orderLines, $orderLinesContainer);

        echo json_encode($orderLinesContainer);
    }


}