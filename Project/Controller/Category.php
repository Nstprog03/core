<?php Ccc::loadClass('Controller_Admin_Action');

class Controller_Category extends Controller_Admin_Action
{
    public function __construct()
    {
        if(!$this->authentication())
        {
            $this->redirect('login','admin_login');
        }
    }

    public function indexAction()
    {
        $this->setTitle('Categoty');
        $content = $this->getLayout()->getContent();
        $categoryGrid = Ccc::getBlock('Category_Index');
        $content->addChild($categoryGrid);

        $this->renderLayout();
    }

    public function gridBlockAction()
    {
        $categoryGrid = Ccc::getBlock('Category_Grid')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $categoryGrid
                ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->renderJson($response);
    }

    public function addBlockAction()
    {

        $categoryModel = Ccc::getModel("Category");
        $media = $categoryModel->getMedia();

        Ccc::register('category',$categoryModel);
        Ccc::register('media',$media);

        $categoryEdit = $this->getLayout()->getBlock('Category_Edit')->toHtml();
        $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
        
        $response = [
            'status' => 'success',
            'elements' => [
                [
                    'element' => '#indexContent',
                    'content' => $categoryEdit
                ],
                [
                    'element' => '#adminMessage',
                    'content' => $messageBlock
                ]
            ]
        ];
        $this->renderJson($response);
    }

    public function editBlockAction()
    {
        try
        {
            $this->setTitle('Edit Category');
            $categoryModel = Ccc::getModel('Category');
            $request = $this->getRequest();

            $id = $request->getRequest('id');
            
            if(!$id)
            {
                throw new Exception("Request Invalid.");
            }

            if(!(int)$id)
            {
                throw new Exception("Request Invalid.");
            }

            $category = $categoryModel->load($id);

            if(!$category)
            {
                throw new Exception("System is unable to find record.");
            }
            $media = $category->getMedia();

            Ccc::register('category',$category);
            Ccc::register('media',$media);

            $categoryEdit = $this->getLayout()->getBlock('Category_Edit')->toHtml();
            $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
            
            $response = [
                'status' => 'success',
                'elements' => [
                    [
                        'element' => '#indexContent',
                        'content' => $categoryEdit
                    ],
                    [
                        'element' => '#adminMessage',
                        'content' => $messageBlock
                    ]
                ]
            ];
            $this->renderJson($response);
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->gridBlockAction();
        }   
    }
    
    public function gridAction()
    {
        $this->setTitle('Category');
        $content = $this->getLayout()->getContent();
        $categoryGrid = Ccc::getBlock('Category_Grid');
        $content->addChild($categoryGrid,'Grid');
        $this->renderLayout();
    }

    public function addAction()
    {
        $this->setTitle('Add Category');
        $categoryModel = Ccc::getModel('Category');
        $content = $this->getLayout()->getContent();
        $categoryAdd = Ccc::getBlock('category_Edit')->setData(['category'=>$categoryModel]);
        $content->addChild($categoryAdd,'Add');
        $this->renderLayout();
    }

    public function saveAction()
    {
        try
        {
            $categoryModel = Ccc::getModel('Category');
            $request = $this->getRequest();
            $id = $request->getRequest('id');
            if($request->isPost())
            {
                $postData = $request->getPost('category');
                $categoryData = $categoryModel->setData($postData);
                if(!empty($id))
                {
                    $categoryData->categoryId = $id;
                    $categoryData->updatedAt = date('y-m-d h:m:s');
                    if(!$postData['parentId'])
                    {
                        $categoryData->parentId = NULL;
                    }
                    $result = $categoryModel->save();
                    if(!$result)
                    {
                        throw new Exception("Sysetm is unable to save your data");   
                    }
                    
                    $allPath = $categoryModel->fetchAll("SELECT * FROM `category` WHERE `path` LIKE '%$id%' ");
                    foreach ($allPath as $path) 
                    {
                        $finalPath = explode('/',$path->path);
                        foreach ($finalPath as $subPath) 
                        {
                            if($subPath == $id)
                            {
                                if(count($finalPath) != 1)
                                {
                                    array_shift($finalPath);
                                }    
                                break;
                            }
                            array_shift($finalPath);
                        }
                        if($path->parentId)
                        {
                            $parentPath = $categoryModel->load($path->parentId);
                            $path->path = $parentPath->path ."/".implode('/',$finalPath);
                        }
                        else
                        {
                            $path->path = $path->categoryId;
                        }
                        $result = $path->save();
                    }
                    $this->getMessage()->addMessage('Data Updated Successfully.',1);
                }
                else
                {
                    $categoryData->createdAt = date('y-m-d h:m:s');
                    if(!$categoryData->parentId)
                    {
                        unset($categoryData->parentId);
                        $insert = $categoryModel->save();
                        if(!$insert->categoryId)
                        {
                            throw new Exception("system is unabel to insert your data");
                        }
                        $categoryId = $insert->categoryId;
                        $categoryData->resetData();
                        $categoryData->path = $categoryId;
                        $categoryData->categoryId = $categoryId;
                        $result = $categoryModel->save();
                        $this->getMessage()->addMessage('data inserted successfully',1);
                    }
                    else
                    {
                        $insert = $categoryModel->save();
                        
                        if(!$insert->categoryId)
                        {
                            throw new Exception("system is unabel to insert your data");
                        }
                        $categoryData->categoryId = $insert->categoryId;
                        $parentPath = $categoryModel->load($categoryData->parentId);
                        $categoryData->path = $parentPath->path."/". $insert->categoryId;
                        $result = $categoryData->save();
                    }
                    if(!$result)
                    {
                        throw new Exception("Sysetm is unable to save your data");   
                    }
                }
                $this->getMessage()->addMessage('Your Data Updated Successfully');
                $categoryGrid = Ccc::getBlock('Category_Grid')->toHtml();
                $messageBlock = Ccc::getBlock('Core_Layout_Message')->toHtml();
                $url = Ccc::getModel('Core_View')->getUrl('editBlock',null,['id' => $categoryModel->categoryId,'tab'=>'media']);
                $response = [
                    'status' => 'success',
                    'elements' => [
                        [
                            'element' => '#adminMessage',
                            'content' => $messageBlock
                        ],
                        [
                            'element' => '#indexContent',
                            'content' => $categoryGrid,
                            'url' => $url
                        ]
                    ]
                ];
                $this->renderJson($response);
            }
        }
        catch (Exception $e) 
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->gridBlockAction();
        }
    }


    public function editAction()
    {
        try
        {
            $this->setTitle('Edit Category');
            $categoryModel = Ccc::getModel('Category');
            $request = $this->getRequest();

            $id = $request->getRequest('id');
            
            if(!$id)
            {
                throw new Exception("Request Invalid.");
            }

            if(!(int)$id)
            {
                throw new Exception("Request Invalid.");
            }

            $category = $categoryModel->load($id);

            if(!$category)
            {
                throw new Exception("System is unable to find record.");
            }

            $content = $this->getLayout()->getContent();
            $categoryEdit = Ccc::getBlock('Category_Edit')->setData(['category'=>$category]);
            $content->addChild($categoryEdit,'Edit');
            $this->renderLayout();
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->redirect('grid','category',[],true);
        }
    }

    public function deleteAction()
    {
        try
        {
            $categoryModel = Ccc::getModel('Category');
            $request = $this->getRequest();

            if(!$request->getRequest('id'))
            {
                throw new Exception("Request Invalid.");
            }

            $id = $request->getRequest('id');

            if(!$id)
            {
                throw new Exception("Unable to find data.");
            }

            $mediaData = $categoryModel->fetchAll("SELECT `name` FROM `category_media` WHERE  `categoryId` = {$id}");
            if($mediaData)
            {
                foreach ($mediaData as $data)
                {
                    unlink(Ccc::getBlock('Category_Grid')->getBaseUrl("Media/category/"). $data->name);
                }
            }

            $result = $categoryModel->load($id);

            if(!$result)
            {
                throw new Exception("Unable to Delete Record.");
            }
            $result->delete();
            $this->getMessage()->addMessage('Data Deleted.');
            $this->gridBlockAction();
        }
        catch (Exception $e) 
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->gridBlockAction();
        }
    }

    public function saveMediaAction()
    {
        try 
        {
            $mediaModel = Ccc::getModel('Category_Media');
            $request = $this->getRequest();
            $id = $request->getRequest('id');
            if($request->isPost())
            {
                if(!$request->getPost())
                {
                    $mediaData = $mediaModel;
                    $mediaData->categoryId = $id;

                    $file = $request->getFile();
                    $ext = explode('.',$file['name']['name']);
                    $fileExt = end($ext);
                    $fileName = prev($ext)."".date('Ymdhis').".".$fileExt;
                    $fileName = str_replace(" ","_",$fileName);
                    $mediaData->name = $fileName;

                    $extension = array('jpg','jpeg','png','Jpg','Jpeg','Png','JPEG','JPG','PNG');

                    if(in_array($fileExt, $extension))
                    {
                        $result = $mediaModel->save();
                        if(!$result)
                        {
                            throw new Exception("System is unable to save your data.");
                        }   
                        move_uploaded_file($file['name']['tmp_name'],Ccc::getBlock('Product_Grid')->getBaseUrl("Media/category/").$fileName);
                    }
                }
                else
                {
                    $mediaData = $mediaModel;
                    $categoryModel = $mediaModel->getCategory();
                    $categoryData = $categoryModel;
                    $categoryData->categoryId = $id;
                    $mediaData->categoryId = $id;
                    $postData = $request->getPost();
                    if(array_key_exists('remove',$postData['media']))
                    {
                        foreach($postData['media']['remove'] as $remove)
                        {
                            $media = $mediaModel->load($remove);
                            $result = $media->delete();

                            if(!$result)
                            {
                                throw new Exception("Invalid request.");
                            }
                            unlink(Ccc::getBlock('Category_Grid')->getBaseUrl("Media/category/"). $media->name);

                            if($postData['media']['base'] == $remove)
                            {
                                unset($postData['media']['base']);
                            }   
                            if($postData['media']['thumb'] == $remove)
                            {
                                unset($postData['media']['thumb']);
                            }
                            if($postData['media']['small'] == $remove)
                            {
                                unset($postData['media']['small']);
                            }
                        }
                    }
    
                    if(array_key_exists('gallery',$postData['media']))
                    {
                        $mediaData->gallery = 2;
                        $result = $mediaModel->save('categoryId');
                        $mediaData->gallery = 1;
                        foreach ($postData['media']['gallery'] as $gallery)
                        {
                            $mediaData->mediaId = $gallery;
                            $result = $mediaModel->save();
                            if(!$result)
                            {
                                throw new Exception("Invalid request.");
                            }
                        }
                        unset($mediaData->mediaId);
                    }
                    else
                    {
                        $mediaData->gallery = 2;
                        $result = $mediaModel->save('categoryId');
                    }
                    unset($mediaData->gallery);

                    if(array_key_exists('base',$postData['media']))
                    {
                        $categoryData->base = $postData['media']['base'];
                        $result = $categoryModel->save();
                        if(!$result)
                        {
                            throw new Exception("System is unabel to set base.");
                        }
                        unset($categoryData->base);
                    }

                    if(array_key_exists('thumb',$postData['media']))
                    {
                        $categoryData->thumb = $postData['media']['thumb'];
                        $result = $categoryModel->save();
                        if(!$result)
                        {
                            throw new Exception("System is unabel to set thumb.");
                        }
                        unset($categoryData->thumb);
                    }

                    if(array_key_exists('small',$postData['media']))
                    {
                        $categoryData->small = $postData['media']['small'];
                        $result = $categoryModel->save();
                        if(!$result)
                        {
                            throw new Exception("System is unabel to set small.");
                        }
                        unset($categoryData->small);
                    }
                }
            }
            $this->getMessage()->addMessage('Data saved.',1); 
            $this->editBlockAction();
        }
        catch (Exception $e)
        {
            $this->getMessage()->addMessage($e->getMessage(),3);
            $this->editBlockAction();
        }
    }
}
