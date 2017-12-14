**框架说明**

*项目采用symfony3.3.10二次开发，实现以下功能*
* [用户系统封装](https://github.com/symfonyDeveloper/demiurge/blob/developer/doc/%E7%94%A8%E6%88%B7.md)
* 添加[serviceKernel](https://github.com/symfonyDeveloper/demiurge/blob/developer/app/ServiceKernel.php)（采用单例模式），方便在程序各个地方获取到kernel，在配置service时，可以减少依赖，直接获取
* session 存储到redis 中，解决多服务器session共享问题, redis地址配置在parameter.yml的session_handler_redis选项，
    有效期目前写死，如有需要，可以修改配置，通过配置服务进行初始化，service配置是app.redis_session_handle
    -   [handle](https://github.com/symfonyDeveloper/demiurge/blob/developer/src/Custom/WebBundle/Handle/RedisSessionHandle.php)
* asset 前端资源配置，添加版本号，域名配置等
* 接口幂等性校验（初步实现，还需要根据实际业务进行调整）
    -   [Custom\WebBundle\Event\ApiIdempotentListener](https://github.com/symfonyDeveloper/demiurge/blob/developer/src/Custom/WebBundle/Event/ApiIdempotentListener.php)
    -   配置在 app/config/services.yml
* json 返回体定义
    -   [Custom\WebBundle\Utils\R](https://github.com/symfonyDeveloper/demiurge/blob/developer/src/Custom/WebBundle/Utils/R.php)
* [RBAC](https://github.com/symfonyDeveloper/demiurge/blob/developer/doc/RBAC.md) （基于角色的权限管理）
* 分页组件([knplabs/knp-paginator-bundle](https://github.com/KnpLabs/KnpPaginatorBundle))
    - 分页模板修改成bootstrap风格
    