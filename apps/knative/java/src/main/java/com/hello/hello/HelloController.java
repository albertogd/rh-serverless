package com.hello.hello;

import org.springframework.http.MediaType;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.HashMap;
import java.util.Map;

@RestController
public class HelloController {

    String greeting = "<h1>Java Spring Boot Application!</h1>Welcome to your basic Java Sprint Boot application";

    @RequestMapping("/")
    public String index() {
        return greeting;
    }

    @RequestMapping("/api")
    @GetMapping(produces = MediaType.APPLICATION_JSON_VALUE)
    public Map<String, String> api() {
        HashMap<String, String> map = new HashMap<>();
        map.put("greeting", greeting);
        return map;
    }

}
